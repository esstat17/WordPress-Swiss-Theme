# WordPress Theme Swiss 
Boilerplate theme for Wordpress. Developed from Twenty Fourteen Theme. 

# Getting Started
Bootstrap Theme for development and production. For further customization, please go to Bootstrap Documentation.

Note: This is limited to Wordpress Theme. 

# Installation 
Download the zip file and extract, and re-Zip the weepeeswiss folder, and upload it in the Theme section.

# Features
Just few of the many features
* Mobile Friendly Navigation (IOS Inspired)
* Seamless Bootstrap Integrated
* Cool Customizer
* Content Starter Introduced in Version 4.7
* Add Logo Enabled
* 15 Built Color to Choose of (colorpicker)
* Flexible Template for Designer
* Supported 1, 2, and 3 columns
* Customizable Frontpage
* Scroll Animation & Transitions in the Navigation
* Able to Add Meta Boxes into Post (Top, Bottom, & Side Content)
* Breadcrumbs Added	
* Cool Modal Search Animation
* Bootstrap Integrated
* Full Size Welcome Screen
* Parallax Effects
* Head Custom Code
* Footer Custom Code
* Top Widgets
* WooComerce Ready
* Awesome Desktop Navigation
* Bootstrap Formatted Breadcrumbs
* Rich Snippet Breadcrumbs
* Popup Search Form in the Header
* Minimum Content Height Fixes
* more to add here.. 

# Customization #
Simply just go to Theme > Customizer 

## Welcome Screen Edits ##
Go to Theme > Customizer > Static Front Page > Welcome Screen

```html
<h5 class="wc-text text-uppercase color-2">Hello! Welcome Guest</h5>
<hr class="shorty-hr border-color-1">
<p class="lead color-2">I will tell you a story as you continue reading</p>
<a href="#more" class="btn btn-primary bg-color-1 color-2 wc-btn">Read more</a>
```

## Content Box ##
Go to Theme > Customizer > Static Front Page > Content Box

```html
<div class="section-front front-box-1">
    <div class="container">
        <div class="row">
            <h2 class="section-heading text-center">4 Cool Boxes</h2>
            <hr class="shorty-hr border-color-1">
            <div class="col-xs-6 col-sm-3 text-center">
                <div class="service-box"><i class="fa fa-cogs fa-5x color-1" aria-hidden="true"></i>
                    <h3>Box One</h3>
                    <p class="box-txt">Let me tell you the story for box one.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 text-center">
                <div class="service-box"><i class="fa fa-handshake-o fa-5x color-1" aria-hidden="true"></i>
                    <h3>Box Two</h3>
                    <p class="box-txt">Let me tell you the story for box two.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 text-center">
                <div class="service-box"><i class="fa fa-area-chart fa-5x color-1" aria-hidden="true"></i>
                    <h3>Box Three</h3>
                    <p class="box-txt">Let me tell you the story for box three.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 text-center">
                <div class="service-box"><i class="fa fa-tachometer fa-5x color-1" aria-hidden="true"></i>
                    <h3>Box Four</h3>
                    <p class="box-txt">Let me tell you the story for box four.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-front front-box-2 bg-color-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading color-2">Just Another Section</h2>
                <hr class="shorty-hr border-color-2">
                <p class="lead color-2">Why not to start another section of your story here? Happy to hear your thoughts!</p>
                <p><a href="#" class="btn btn-default btn-oval bg-color-2">Get Started</a>
                </p>
            </div>
        </div>
    </div>
</div>

```
## Just another HTML section ##
```html
<div class="section-front front-box-2 bg-color-1">
<div class="container"><div class="row">
<div class="col-lg-8 col-lg-offset-2 text-center">
<h2 class="section-heading color-2">Just Another Section</h2>
<hr class="shorty-hr border-color-2">
<p class="lead color-2">
Why not to start another section of your story here? Happy to hear your thoughts!
</p>
<p>
<a class="page-scroll btn btn-default btn-oval bg-color-2">Get Started!</a>
</p>
</div>
</div></div>
</div>
```

## Widgets ##
Go to Theme > Customizer > Widgets > Add Text

### Navigation Upper Right ###
```html
<div class="nav-list-starter">
    <ul class="item-group">
        <li class="item-list"><a href="#">Login</a>
        </li>
        <li class="item-list"><a href="#">Pricing</a>
        </li>
        <li class="item-list"><a href="#">Shop</a>
        </li>
    </ul>
</div>
```

### Navigation Lower Right ###
```html
<div class="item-group">
    <a href="#" class="item-list icon-language hide-smartphone">
        <span class="fa fa-globe fa-2x color-1"></span>
        <span class="lang-txt display-block">EN</span>
    </a>
    <a href="#" class="item-list icon-currency hide-smartphone">
        <span class="fa fa-eur fa-2x color-1"></span>
        <span class="currency-txt display-block">EUR</span>
    </a>
    <a href="#" class="item-list icon-cart">
        <span class="fa fa-shopping-cart fa-2x color-1"></span>
        <span class="cart-txt display-block">Cart</span>
    </a>
    <a href="#" class="item-list btn btn-primary bg-color-1 color-2 btn-oval show-on-scroll">Explore</a>
</div>
```
Also try to add search widget, it will automatically turn into modal search popup

### Footer Widget Area (2) ###
```html
<p><strong><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; Address</strong>
    <br />123 Main Street
    <br />New York, NY 10001</p>
<p><strong><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; Hours</strong>
    <br />Monday&mdash;Friday: 9:00AM&ndash;5:00PM
    <br />
</p>
<p><strong><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; Email me</strong>
    <br /><a href="mailto:hello@wordpress.com">hello@wordpress.com</a>
    <br />
</p>
```

### Footer Widget Area (4) ###
Just add Contact Us chars as title
```html
<form class="form-footer" action="" method="post">
    <fieldset>
        <div class="clearfix"></div>
        <div class="form-group clearfix">
            <input type="text" name="name" value="" size="40" class="form-control" placeholder="your name">
        </div>
        <div class="form-group clearfix">
            <input type="email" name="email" value="your@email.com" size="40" class="form-control">
        </div>
        <div class="form-group clearfix">
            <textarea name="message" cols="40" rows="4" class="form-control">your message here ...</textarea>
        </div>
        <div class="form-group clearfix">
            <div class="text-right">
                <input type="submit" value="Send" class="btn bg-color-2 color-4 pull-right" id="send-me">
            </div>
        </div>
    </fieldset>
</form>
```
Note: This is just a plain HTML, you have to integrate it with other plugin using their provided shortcode.

If you want to peek code snippet when I integrate it with contact form 7
```html
<div class="contact-form-footer">
        <fieldset>
             <div class="clearfix"></div>
            <div class="form-group clearfix">
            [text* id:name class:form-control your-name placeholder "your name"]
            </div>
            <div class="form-group clearfix">
            [email* id:email class:form-control your-email "your@email.com"]
            </div>
            <div class="form-group clearfix">
            [textarea* id:message class:form-control your-message 40x4 "your message here ..."]
            </div>
            <div class="form-group clearfix">
              <div class="text-right">[submit id:send-me class:btn class:bg-color-2 class:color-1 class:pull-right "Send"]</div>
            </div>
        </fieldset>
</div>
```

Note: This only works if Contact Form 7 is installed.


## On the final note ##
This theme still needs in-depth documentation, I will gradually fill the readme file upon updates. 

It is very recommended for newly installed Wordpress platform, though it can work for your existing wordpress website, all you have to do is to manually edit it. 

Feel free to use it, enjoy!


