## Easy sdk

一个快速构建PHP版本SDK的解决方案

[![Build Status](https://travis-ci.com/itsanr-oris/easy-sdk.svg?branch=master)](https://travis-ci.com/itsanr-oris/easy-sdk)
[![Latest Stable Version](https://poser.pugx.org/f-oris/easy-sdk/v)](//packagist.org/packages/f-oris/easy-sdk)
[![Total Downloads](https://poser.pugx.org/f-oris/easy-sdk/downloads)](//packagist.org/packages/f-oris/easy-sdk)
[![Latest Unstable Version](https://poser.pugx.org/f-oris/easy-sdk/v/unstable)](//packagist.org/packages/f-oris/easy-sdk)
[![License](https://poser.pugx.org/f-oris/easy-sdk/license)](//packagist.org/packages/f-oris/easy-sdk)


## 环境要求

- php >= 5.5

## 使用教程

#### 安装 easy-sdk-installer

```bash
$ composer global require f-oris/easy-sdk-installer
```

#### 创建 Sdk 项目

执行sdk项目创建命令，按要求填入各项信息，完成sdk项目创建

```bash
$ easy-sdk new sdk-demo
```

#### Sdk组件开发

进入`sdk-demo`目录，执行命令创建组件

```bash
$ php artisan make:component Hello/Hello
```

命令执行完毕后，可在`src/Hello`目录内找到`Hello`组件代码类文件，完善组件代码，以输出一句"Hello, easy sdk framework."为例，如下：

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

#### Sdk组件测试

创建`sdk-demo/tests/Hello`目录，再在目录内创建测试文件类`HelloComponentTest`，注意需要继承框架测试基类`TestCase`，编写测试脚本，如下：

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

执行`vendor/bin/phpunit`命令，完成Sdk项目组件开发

> 建议组件测试代码目录与组件代码相对目录保持一致，方便排查调试

#### 发布Sdk代码包

按照[packagist](https://packagist.org/)组件包发布指引，发布Sdk代码包，待composer仓库同步完毕后，即可通过composer拉取sdk组件代码包进行使用

## 其他

更多框架使用教程，请参考[使用文档](https://f-oris.gitbook.io/easy-sdk/)相关说明。

## 推荐组件包

1. [easy-sdk-logger](https://github.com/itsanr-oris/easy-sdk-logger) Logger组件包
2. [easy-sdk-httpclient](https://github.com/itsanr-oris/easy-sdk-httpclient) HttpClient组件包
3. [easy-sdk-cache](https://github.com/itsanr-oris/easy-sdk-cache) Cache组件包
4. [easy-sdk-develop](https://github.com/itsanr-oris/easy-sdk-develop) Easy sdk开发辅助扩展包

## License

MIT License

Copyright (c) 2019-present F.oris <us@f-oris.me>
