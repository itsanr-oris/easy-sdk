## 简介

Easy sdk 是一个快速构建PHP版本SDK的解决方案

[![Latest Stable Version](https://poser.pugx.org/f-oris/easy-sdk/v)](//packagist.org/packages/f-oris/easy-sdk) [![Total Downloads](https://poser.pugx.org/f-oris/easy-sdk/downloads)](//packagist.org/packages/f-oris/easy-sdk) [![Latest Unstable Version](https://poser.pugx.org/f-oris/easy-sdk/v/unstable)](//packagist.org/packages/f-oris/easy-sdk) [![License](https://poser.pugx.org/f-oris/easy-sdk/license)](//packagist.org/packages/f-oris/easy-sdk)

## 版本说明

当前最新版本为2.x版本，区别于1.x版本将各种组件包笼统的合并到一起，2.x版本做了全新的框架设计，引入SDK基础框架的概念，各组件通过框架规范，由开发者自主选择是否加载相应的功能组件，同时开发者也可以按照组件加载规范要求，开发自己的SDK组件扩展包。

特别说明：由于1.x与2.x的系统设计、系统功能不一致，1.x与2.x不兼容。

## 快速上手

1. 安装easy-sdk-installer

```bash
composer global require f-oris/easy-sdk-installer
```

easy-sdk-installer是一个快速创建SDK项目的指令包，通过该扩展包，开发者可以快速创建SDK项目

2. 创建sdk项目

```bash
easy-sdk new sdk-demo
```

执行命令后，按照提示依次填入sdk包名、描述、作者、根命名空间，即可完成创建

3. 创建组件

```bash
php artisan make:component Hello/Hello
```

执行该命令完毕后，在 `src` 目录下可以找到相应的组件信息，具体文件路径为 `src/Hello/Hello.php`，打开该文件，增加一个hello组件功能，返回一个问候语字符串

```php
<?php

namespace Foris\Easy\Sdk\Skeleton\Hello;

use Foris\Easy\Sdk\Component;

/**
 * Class Hello
 */
class Hello extends Component
{
    /**
     * Return a hello message.
     *
     * @return string
     */
    public function hello()
    {
        return "Hello, easy sdk framework.";
    }
}
```

4. 调用组件

组件创建完毕后，会自动注册到SDK服务容器中，注册的ID为：Component::name()，在实际业务逻辑处可以通过该ID获取组件实例，完成相应的业务逻辑

```php
<?php

$app = new \Foris\Easy\Sdk\Skeleton\Application();
$app->get(\Foris\Easy\Sdk\Skeleton\Hello\Hello::name())->hello();
// Hello, easy sdk framework.

```

## 核心构架

1. 服务容器（ServiceContainer）

Easy sdk 框架的服务容器基于 `pimple/pimple` 容器基础上构建，增加四个简单明了的快捷操作：singleton、bind、rebind、get，分别对应着注册单例服务、注册服务、重新注册服务、获取服务实例，具体使用如下(可参考laravel服务注册)

```php
<?php
$app = new \Foris\Easy\Sdk\Skeleton\Application();

// 注册单例组件
$app->singleton('hello.singleton', function ($app) {
    // 此处的$app为当前容器实例
    return new Foris\Easy\Sdk\Skeleton\Hello\Hello($app);
});

// 注册普通组件
$app->bind('hello-message.bind', function () {
    return 'Hello message from easy sdk framework.';
});

// 重新注册服务
$app->rebind('hello.bind', function () {
    return 'New hello message from easy sdk framework.';
});

// 获取服务实例
$app->get('hello.bind');
// New hello message from easy sdk framework.

```

2. 服务提供者（ServiceProvider）

服务提供者是SDK组件引导、加载到服务容器核心组件。所有服务提供者都需要继承`Foris\Easy\Sdk\ServiceProvider`类，大多数情况下，服务提供者需要实现`register`方法，并在该方法内将具体的组件服务注册到服务容器内，开发者可通过具体的服务注册ID在容器内获取具体的组件服务实例，执行实际业务逻辑处理。服务提供者主要提供以下几种组件服务注册功能：组件注册、配置信息注册、组件命令注册，实例代码如下（参考laravel：Illuminate\Support\ServiceProvider）

```php
<?php

namespace Foris\Easy\Sdk\Skeleton;

/**
 * Class ServiceProvider
 */
class ServiceProvider extends \Foris\Easy\Sdk\ServiceProvider
{
    /**
     * Register logger component
     */
    public function register()
    {
        // 合并配置信息
        $this->mergeConfigFrom(__DIR__ . '/config/app.php', 'app');

        // 注册服务配置信息，此处注册后，可通过vendor:publish命令把配置文件发布到config目录下
        $this->publishes([
            __DIR__ . '/config/app.php' => $this->app()->getConfigPath('app.php')
        ]);

        # 注册自定义命令实例
        $this->app()->bind('custom.command', function () {
            // 返回自定义命令实例
        });
        
        # 注册自定义命令
        $this->commands(['custom.command']);
    }
}

```

## 基础功能

1. 组件配置管理

Easy sdk 框架默认加载配置管理组件(Config)，用于管理整个SDK应用程序在运行过程中所使用到的各种配置信息，主要使用方式如下：

```php
<?php
/**
 * 假设当前sdk配置目录下有一个配置文件，app.php, 内容如下
 *
 * [
 *     "app_key": "app_key_value",
 *     "app_secret": "app_secret_value"
 * ] 
 */
$app = new \Foris\Easy\Sdk\Skeleton\Application();
print_r($app->get('config')->get('app.app_key'));
// app_key_value

print_r($app->get('config')->get('not_exists_config_item', 'default'));
// default

```

2. 错误与日志

Easy sdk 框架默认加载日志组件，支持 `signle`, `daily` 两种日志写入模式，开发者可以通过修改 `config/logger.php` 中的配置信息，更改日志写入以及存储方式；该组件遵循 `PSR-3` 日志接口规范，开发者可根据SDK的实际应用场景，使用其他遵循 `PSR-3` 规范的日志组件替换该组件实例，如SDK在适配laravel框架时，可用laravel框架内的logger组件替换掉SDK内的logger组件，以方便开发者自身进行开发调试。

```php
<?php

$app = new \Foris\Easy\Sdk\Skeleton\Application();

// 重新注册logger组件
$app->singleton('logger', function () {
    // 返回新的日志组件实例
});

$app->get('logger')->debug('debug info');

```

## 组件包开发

以日志组件包easy-sdk-logger为例

1. 完成easy-logger扩展包基础功能开发

2. 新建一个组件包项目，引入easy-logger扩展包，并完成Easy sdk服务提供者代码编写，核心代码如下

```php
<?php

namespace Foris\Easy\Sdk\Logger;

use Foris\Easy\Logger\Driver\Factory;
use Foris\Easy\Logger\Logger;

/**
 * Class ServiceProvider
 */
class ServiceProvider extends \Foris\Easy\Sdk\ServiceProvider
{
    /**
     * Register logger component
     *
     * @throws \ReflectionException
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/logger.php', 'logger');

        $this->publishes([
            __DIR__ . '/config/logger.php' => $this->app()->getConfigPath('logger.php')
        ]);

        $this->app()->singleton('logger_driver', function () {
            return new Factory();
        });

        $this->app()->singleton('logger', function () {
            return new Logger($this->app()->get('logger_driver'), $this->app()->get('config')->get('logger'));
        });
    }
}

```

3. 测试并完善扩展包功能。引入 `f-oris/easy-sdk-develop` 扩展包，编写测试代码如下

```php
<?php

namespace Foris\Easy\Sdk\Logger\Tests;

use Foris\Easy\Logger\Logger;
use Foris\Easy\Sdk\Develop\TestCase;
use Foris\Easy\Sdk\Logger\ServiceProvider;

/**
 * Class GetLoggerInstanceTest
 */
class GetLoggerInstanceTest extends TestCase
{
    /**
     * Set up test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // 加载ServiceProvider
        $this->app()->registerProviders([ServiceProvider::class]);
    }

    /**
     * Test get logger instance.
     */
    public function testGetLoggerInstance()
    {
        // 判断能否从服务容器中获取到正确的日志实例
        $this->assertInstanceOf(Logger::class, $this->app()->get('logger'));
    }

    /**
     * Test get logger configuration.
     */
    public function testGetLoggerConfiguration()
    {
        // 判断日志配置是否正常加载
        $config = require __DIR__ . '/../src/config/logger.php';
        $this->assertEquals($config, $this->app()->get('config')->get('logger'));
    }
}
```

4. 打开composer.json文件，写入如下内容，以便Easy sdk服务容器识别并自动加载此服务提供者

```json
{
    "extra": {
        "easy-sdk": {
            "providers": [
                "Foris\\Easy\\Sdk\\Logger\\ServiceProvider"
            ]
        }
    }
}
```

5. 到packagist提交发布组件包，发布完毕后，即可在SDK项目中引入组件包并应用到实际业务中

## 推荐组件包

1. [easy-sdk-logger](https://github.com/itsanr-oris/easy-sdk-logger) Logger组件包
2. [easy-sdk-httpclient](https://github.com/itsanr-oris/easy-sdk-httpclient) HttpClient组件包
3. [easy-sdk-cache](https://github.com/itsanr-oris/easy-sdk-cache) Cache组件包
4. [easy-sdk-develop](https://github.com/itsanr-oris/easy-sdk-develop) Easy sdk开发辅助扩展包

## 特别鸣谢

本项目大量参考[laravel](https://github.com/laravel/laravel)项目以及[easy-wechat](https://github.com/overtrue/wechat)项目的设计思路构建实现，如果没有这两个优秀的项目的提供一些实现上的参考，可能也不会有easy sdk这个项目的诞生，虽然相互不认识，还是要在此对这两个项目团队表示由衷的敬意与感谢。

## License

MIT License

Copyright (c) 2019-present F.oris <us@f-oris.me>
