## Easy sdk

一个快速构建PHP版本SDK的解决方案

[![Build Status](https://travis-ci.com/itsanr-oris/easy-sdk.svg?branch=master)](https://travis-ci.com/itsanr-oris/easy-sdk)
[![Latest Stable Version](https://poser.pugx.org/f-oris/easy-sdk/v)](//packagist.org/packages/f-oris/easy-sdk)
[![Total Downloads](https://poser.pugx.org/f-oris/easy-sdk/downloads)](//packagist.org/packages/f-oris/easy-sdk)
[![Latest Unstable Version](https://poser.pugx.org/f-oris/easy-sdk/v/unstable)](//packagist.org/packages/f-oris/easy-sdk)
[![License](https://poser.pugx.org/f-oris/easy-sdk/license)](//packagist.org/packages/f-oris/easy-sdk)


## 环境要求

- php >= 5.5

## 基本使用

#### 1. 安装easy-sdk-installer

通过composer进行全局安装，如下

```bash
$ composer global require f-oris/easy-sdk-installer
```

> 注意需要将 `~/.composer/vendor/bin` 目录设置到 `PATH` 环境变量中，否则无法识别第二步中的 easy-sdk 命令

#### 2. 创建Sdk应用

执行Sdk初始化创建命令

```bash
$ easy-sdk new sdk-demo
```

按照命令行提示，依次输入以下包名、介绍、作者、根命名空间，`easy-sdk`指令会读取当前目录信息以及Git认证信息生成默认SDK应用信息，如不需要调整，直接回车确认即可

#### 3. Sdk组件开发

进入`sdk-demo`目录，执行命令创建组件

```bash
php artisan make:component Hello/Hello
```

命令执行完毕后，即可在`src`目录内可以看到`Hello`子目录，子目录内包含一个Hello.php文件，这个文件内只是一个空的组件类，我们需要根据业务完善相关业务代码。以输出一句“Hello, easy sdk framework.”为例，代码片段如下

```php
<?php
// ...

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

#### 4. Sdk组件测试

在`tests`下新建`Hello`文件夹，新建HelloTest.php测试类，需要继承基类tests/TestCase.php，按照常规的phpunit进行测试即可，如下

```php
<?php
// ...

class HelloComponentTest extends TestCase
{
    /**
     * Test get a hello message from hello component.
     */
    public function testGetAHelloMessageFromHelloComponent()
    {
        $this->assertEquals('Hello, easy sdk framework.', $this->app()->get(Hello::name())->hello());
    }
}
```

#### 5. 发布Sdk代码包

功能测试完毕后，按照[packagist](https://packagist.org/)组件包发布指引，发布Sdk代码包，待composer仓库同步完毕后，即可通过composer拉取sdk组件代码包进行使用

## 使用扩展包扩展系统功能

Easy-sdk只是一个简单的Sdk应用框架，主要用于Sdk应用的组件管理，本身并不提供太多复杂功能，可通过引入外部组件扩展包来丰富Sdk应用的基础功能服务，以较为常用的Http服务为例，为Sdk应用引入Http功能组件。

#### 1. 引入功能组件包

进入`sdk-demo`目录，通过composer引入http组件包

```bash
$ composer require f-oris/easy-sdk-httpclient
```

#### 2. 发布Http组件配置文件

进入`sdk-demo`目录，执行artisan命令

```bash
$ php artisan vendor:publish --provider="Foris\Easy\Sdk\HttpClient\ServiceProvider"
```

命令执行完毕后，即可在项目目录内`config`文件下找到`http-client.php`配置文件

#### 3. 使用Http组件服务

每一个Sdk组件都是通过Application获取到相应的组件实例才能进行调用相应的组件功能方法，获取Http组件的方式实例如下：

```php
<?php
//...
$http = (new Application())->get(\Foris\Easy\HttpClient\HttpClient::class);
```

由于组件的生命周期其实是包含在Application的生命周期里面的，所以，在组件中就不能以上述方式进行调用，组件的调用方式如下：

```php
<?php
//...
$http = $this->app()->get(\Foris\Easy\HttpClient\HttpClient::class);
```

另外，eask-sdk-httpclient扩展包提供了一个`HasHttpClient`的Trait类，开发人员可以在`src/Component.php`文件中引入并使用该类，简化之后的Http组件调用方式如下

```php
<?php
//...
$http = $this->http();
```

> Http组件扩展包提供具体功能参考f-oris/easy-sdk-httpclient扩展包说明

#### 4. 扩展包列表

1. [easy-sdk-logger](https://github.com/itsanr-oris/easy-sdk-logger) Logger组件包
2. [easy-sdk-httpclient](https://github.com/itsanr-oris/easy-sdk-httpclient) HttpClient组件包
3. [easy-sdk-cache](https://github.com/itsanr-oris/easy-sdk-cache) Cache组件包
4. [easy-sdk-develop](https://github.com/itsanr-oris/easy-sdk-develop) Easy-sdk开发辅助扩展包

## License

MIT License

Copyright (c) 2019-present F.oris <us@f-oris.me>
