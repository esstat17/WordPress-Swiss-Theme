/*	
 * mlmenu v1.0.2
 */
(function($) {

    var SLIDEMENU = 'mlmenu',
        _ADDON_ = 'offCanvas';


    //	Plugin already exists
    if ($[SLIDEMENU]) {
        return;
    }

    /** Class **/

    $[SLIDEMENU] = function($menu, opts, conf) {
        this.$menu = $menu;
        this._api = ['bind', 'init', 'update', 'setSelected', 'getInstance', 'openPanel', 'closePanel', 'closeAllPanels'];
        this.opts = opts;
        this.conf = conf;
        this.vars = {};
        this.cbck = {};

        this._initMenu();
        this._initAnchors();

        var $panels = this.$menu.children(this.conf.panelNodetype);

        this._initAddons();
        this.init($panels);

        return this;
    };

    $[SLIDEMENU].addons = {};
    $[SLIDEMENU].uniqueId = 0;


    $[SLIDEMENU].defaults = {
        extensions: [],
        slidemenu: {
            add: true,
            navtitle: 'Menu',
            titleLink: 'panel'
        },
        onClick: {
            //			close			: true,
            //			blockUI			: null,
            //			preventDefault	: null,
            setSelected: true
        },
        slidingSubmenus: true
    };

    $[SLIDEMENU].configuration = {
        classNames: {
            divider: 'Divider',
            inset: 'Inset',
            panel: 'Panel',
            selected: 'Selected',
            spacer: 'Spacer',
            vertical: 'Vertical'
        },
        clone: false,
        openingInterval: 25,
        panelNodetype: 'ul, ol, div',
        transitionDuration: 400
    };

    $[SLIDEMENU].prototype = {

        init: function($panels) {
            $panels = $panels.not('.' + objc.nopanel);
            $panels = this._initPanels($panels);

            this.trigger('init', $panels);
            this.trigger('update');
        },

        update: function() {
            this.trigger('update');
        },

        setSelected: function($i) {
            this.$menu.find('.' + objc.listview)
                .children()
                .removeClass(objc.selected);
            $i.addClass(objc.selected);
            this.trigger('setSelected', $i);
        },

        openPanel: function($panel) {
            var $l = $panel.parent();

            //	Vertical
            if ($l.hasClass(objc.vertical)) {
                var $sub = $l.parents('.' + objc.subopened);
                if ($sub.length) {
                    return this.openPanel($sub.first());
                }
                $l.addClass(objc.opened);
            }

            //	Horizontal
            else {
                if ($panel.hasClass(objc.current)) {
                    return;
                }

                var $panels = this.$menu.children('.' + objc.panel),
                    $current = $panels.filter('.' + objc.current);

                $panels.removeClass(objc.highest).removeClass(objc.current).not($panel).not($current).not('.' + objc.vertical).addClass(objc.hidden);

                if ($panel.hasClass(objc.opened)) {
                    $panel.nextAll('.' + objc.opened)
                        .addClass(objc.highest)
                        .removeClass(objc.opened)
                        .removeClass(objc.subopened);
                } else {
                    $panel.addClass(objc.highest);
                    $current.addClass(objc.subopened);
                }

                $panel.removeClass(objc.hidden).addClass(objc.current);

                //	Without the timeout, the animation won't work because the element had display: none;
                setTimeout(
                    function() {
                        $panel.removeClass(objc.subopened).addClass(objc.opened);

                    }, this.conf.openingInterval
                );
            }
            this.trigger('openPanel', $panel);
        },

        closePanel: function($panel) {
            var $l = $panel.parent();

            //	Vertical only
            if ($l.hasClass(objc.vertical)) {
                $l.removeClass(objc.opened);
                this.trigger('closePanel', $panel);
            }
        },

        closeAllPanels: function() {
            //	Vertical
            this.$menu.find('.' + objc.listview)
                .children()
                .removeClass(objc.selected)
                .filter('.' + objc.vertical)
                .removeClass(objc.opened);

            //	Horizontal
            var $pnls = this.$menu.children('.' + objc.panel),
                $frst = $pnls.first();

            this.$menu.children('.' + objc.panel)
                .not($frst)
                .removeClass(objc.subopened)
                .removeClass(objc.opened)
                .removeClass(objc.current)
                .removeClass(objc.highest)
                .addClass(objc.hidden);

            this.openPanel($frst);
        },

        togglePanel: function($panel) {
            var $l = $panel.parent();

            //	Vertical only
            if ($l.hasClass(objc.vertical)) {
                this[$l.hasClass(objc.opened) ? 'closePanel' : 'openPanel']($panel);
            }
        },

        getInstance: function() {
            return this;
        },

        bind: function(event, fn) {
            this.cbck[event] = this.cbck[event] || [];
            this.cbck[event].push(fn);
        },

        trigger: function() {
            var that = this,
                args = Array.prototype.slice.call(arguments),
                evnt = args.shift();

            if (this.cbck[evnt]) {
                for (var e = 0, l = this.cbck[evnt].length; e < l; e++) {
                    this.cbck[evnt][e].apply(that, args);
                }
            }
        },

        _initMenu: function() {
            var that = this;

            //	Clone if needed
            if (this.opts.offCanvas && this.conf.clone) {
                this.$menu = this.$menu.clone(true);
                this.$menu.add(this.$menu.find('[id]')).filter('[id]').each(
                        function() {
                            $(this)
                                .attr('id', objc.mm($(this)
                                    .attr('id')));
                        }
                    );
            }

            //	Strip whitespace
            this.$menu.contents()
                .each(
                    function() {
                        if ($(this)[0].nodeType == 3) {
                            $(this)
                                .remove();
                        }
                    }
                );

            this.$menu
                .parent()
                .addClass(objc.wrapper);

            var clsn = [objc.menu];

            //	Add direction class
            if (!this.opts.slidingSubmenus) {
                clsn.push(objc.vertical);
            }

            //	Add extensions
            this.opts.extensions = (this.opts.extensions.length) ? 'ml-' + this.opts.extensions.join(' ml-') : '';

            if (this.opts.extensions) {
                clsn.push(this.opts.extensions);
            }

            this.$menu.addClass(clsn.join(' '));
        },

        _initPanels: function($panels) {
            var that = this;

            //	Add List class
            var $lists = this.__findAddBack($panels, 'ul, ol');

            this.__refactorClass($lists, this.conf.classNames.inset, 'inset')
                .addClass(objc.nolistview + ' ' + objc.nopanel);

            $lists.not('.' + objc.nolistview)
                .addClass(objc.listview);

            var $lis = this.__findAddBack($panels, '.' + objc.listview)
                .children();

            //	Refactor Selected class
            this.__refactorClass($lis, this.conf.classNames.selected, 'selected');

            //	Refactor divider class
            this.__refactorClass($lis, this.conf.classNames.divider, 'divider');

            //	Refactor Spacer class
            this.__refactorClass($lis, this.conf.classNames.spacer, 'spacer');

            //	Refactor Panel class
            this.__refactorClass(this.__findAddBack($panels, '.' + this.conf.classNames.panel), this.conf.classNames.panel, 'panel');

            //	Create panels
            var $curpanels = $(),
                $oldpanels = $panels
                .add($panels.find('.' + objc.panel))
                .add(this.__findAddBack($panels, '.' + objc.listview).children().children(this.conf.panelNodetype))
                .not('.' + objc.nopanel);

            this.__refactorClass($oldpanels, this.conf.classNames.vertical, 'vertical');

            if (!this.opts.slidingSubmenus) {
                $oldpanels.addClass(objc.vertical);
            }

            $oldpanels
                .each(
                    function() {
                        var $t = $(this),
                            $p = $t;

                        if ($t.is('ul, ol')) {
                            $t.wrap('<div class="' + objc.panel + '" />');
                            $p = $t.parent();
                        } else {
                            $p.addClass(objc.panel);
                        }

                        var id = $t.attr('id');
                        $t.removeAttr('id');
                        $p.attr('id', id || that.__getUniqueId());

                        if ($t.hasClass(objc.vertical)) {
                            $t.removeClass(that.conf.classNames.vertical);
                            $p.add($p.parent())
                                .addClass(objc.vertical);
                        }

                        $curpanels = $curpanels.add($p);
                    }
                );

            var $allpanels = $('.' + objc.panel, this.$menu);

            //	Add open and close links to menu items
            $curpanels
                .each(
                    function(i) {
                        var $t = $(this),
                            $p = $t.parent(),
                            $a = $p.children('a, span').first();

                        if (!$p.is('.' + objc.menu)) {
                            $p.data(objd.sub, $t);
                            $t.data(objd.parent, $p);
                        }

                        //	Open link
                        if (!$p.children('.' + objc.next).length) {
                            if ($p.parent()
                                .is('.' + objc.listview)) {
                                var id = $t.attr('id'),
                                    $b = $('<a class="' + objc.next + '" href="#' + id + '" data-target="#' + id + '" />')
                                    .insertBefore($a);

                                if ($a.is('span')) {
                                    $b.addClass(objc.fullsubopen);
                                }
                            }
                        }

                        //	Navbar
                        if (!$t.children('.' + objc.slidemenu).length) {
                            if (!$p.hasClass(objc.vertical)) {
                                if ($p.parent()
                                    .is('.' + objc.listview)) {
                                    //	Listview, the panel wrapping this panel
                                    var $p = $p.closest('.' + objc.panel);
                                } else {
                                    //	Non-listview, the first panel that has an anchor that links to this panel
                                    var $a = $p.closest('.' + objc.panel)
                                        .find('a[href="#' + $t.attr('id') + '"]')
                                        .first(),
                                        $p = $a.closest('.' + objc.panel);
                                }

                                var $slidemenu = $('<div class="' + objc.slidemenu + '" />'),
                                    closex = '<a class="ml-close ml-btn glyphicon glyphicon-remove" href="#ml-0"></a>';

                                if ($p.length) {
                                    var id = $p.attr('id');
                                    switch (that.opts.slidemenu.titleLink) {
                                        case 'anchor':
                                            _url = $a.attr('href');
                                            break;

                                        case 'panel':
                                        case 'parent':
                                            _url = '#' + id;
                                            break;

                                        case 'none':
                                        default:
                                            _url = false;
                                            break;
                                    }

                                    $slidemenu
                                        .append('<a class="' + objc.btn + ' ' + objc.prev + '" href="#' + id + '" data-target="#' + id + '"></a>')
                                        .append('<a class="' + objc.navtitle + '"' + (_url ? ' href="' + _url + '"' : '') + '>' + $a.text() + '</a>')
                                        .append(closex)
                                        .prependTo($t);

                                    if (that.opts.slidemenu.add) {
                                        $t.addClass(objc.hasslidemenu);
                                    }
                                } else if (that.opts.slidemenu.navtitle) {
                                    $slidemenu
                                        .append('<a class="' + objc.navtitle + '">' + that.opts.slidemenu.navtitle + '</a>')
                                        .append(closex)
                                        .prependTo($t);

                                    if (that.opts.slidemenu.add) {
                                        $t.addClass(objc.hasslidemenu);
                                    }
                                }
                            }
                        }
                    }
                );


            //	Add opened-classes to parents
            var $s = this.__findAddBack($panels, '.' + objc.listview)
                .children('.' + objc.selected)
                .removeClass(objc.selected)
                .last()
                .addClass(objc.selected);

            $s.add($s.parentsUntil('.' + objc.menu, 'li'))
                .filter('.' + objc.vertical)
                .addClass(objc.opened)
                .end()
                .not('.' + objc.vertical)
                .each(
                    function() {
                        $(this).parentsUntil('.' + objc.menu, '.' + objc.panel).not('.' + objc.vertical).first().addClass(objc.opened).parentsUntil('.' + objc.menu, '.' + objc.panel).not('.' + objc.vertical).first().addClass(objc.opened).addClass(objc.subopened);
                    }
                );


            //	Add opened-classes to child
            $s.children('.' + objc.panel)
                .not('.' + objc.vertical)
                .addClass(objc.opened)
                .parentsUntil('.' + objc.menu, '.' + objc.panel)
                .not('.' + objc.vertical)
                .first()
                .addClass(objc.opened)
                .addClass(objc.subopened);


            //	Set current opened
            var $current = $allpanels.filter('.' + objc.opened);
            if (!$current.length) {
                $current = $curpanels.first();
            }
            $current
                .addClass(objc.opened)
                .last()
                .addClass(objc.current);


            //	Rearrange markup
            $curpanels
                .not('.' + objc.vertical)
                .not($current.last())
                .addClass(objc.hidden)
                .end()
                .appendTo(this.$menu);

            return $curpanels;
        },

        _initAnchors: function() {
            var that = this;

            glbl.$body
                .on(obje.click + '-oncanvas',
                    'a[href]',
                    function(e) {
                        var $t = $(this),
                            fired = false,
                            inMenu = that.$menu.find($t).length;

                        //	Find behavior for addons
                        for (var a in $[SLIDEMENU].addons) {
                            if (fired = $[SLIDEMENU].addons[a].clickAnchor.call(that, $t, inMenu)) {
                                break;
                            }
                        }

                        //	Open/Close panel
                        if (!fired && inMenu) {
                            var _h = $t.attr('href');
                            if (_h.length > 1 && _h.slice(0, 1) == '#') {
                                try {
                                    var $h = $(_h, that.$menu);
                                    if ($h.is('.' + objc.panel)) {
                                        fired = true;
                                        that[$t.parent()
                                            .hasClass(objc.vertical) ? 'togglePanel' : 'openPanel']($h);
                                    }
                                } catch (err) {}
                            }
                        }

                        if (fired) {
                            e.preventDefault();
                        }


                        //	All other anchors in lists
                        if (!fired && inMenu) {
                            if ($t.is('.' + objc.listview + ' > li > a') && !$t.is('[rel="external"]') && !$t.is('[target="_blank"]')) {

                                //	Set selected item
                                if (that.__valueOrFn(that.opts.onClick.setSelected, $t)) {
                                    that.setSelected($(e.target)
                                        .parent());
                                }

                                //	Prevent default / don't follow link. Default: false
                                var preventDefault = that.__valueOrFn(that.opts.onClick.preventDefault, $t, _h.slice(0, 1) == '#');
                                if (preventDefault) {
                                    e.preventDefault();
                                }

                                //	Block UI. Default: false if preventDefault, true otherwise
                                if (that.__valueOrFn(that.opts.onClick.blockUI, $t, !preventDefault)) {
                                    glbl.$html.addClass(objc.blocking);
                                }

                                //	Close menu. Default: true if preventDefault, false otherwise
                                if (that.__valueOrFn(that.opts.onClick.close, $t, preventDefault)) {
                                    that.close();
                                }
                            }
                        }
                    }
                );
        },

        _initAddons: function() {
            //	Add add-ons to plugin
            for (var a in $[SLIDEMENU].addons) {
                $[SLIDEMENU].addons[a].add.call(this);
                $[SLIDEMENU].addons[a].add = function() {};
            }

            //	Setup adds-on for menu
            for (var a in $[SLIDEMENU].addons) {
                $[SLIDEMENU].addons[a].setup.call(this);
            }
        },

        __api: function() {
            var that = this,
                api = {};

            $.each(this._api,
                function(i) {
                    var fn = this;
                    api[fn] = function() {
                        var re = that[fn].apply(that, arguments);
                        return (typeof re == 'undefined') ? api : re;
                    }
                }
            );
            return api;
        },

        __valueOrFn: function(o, $e, d) {
            if (typeof o == 'function') {
                return o.call($e[0]);
            }
            if (typeof o == 'undefined' && typeof d != 'undefined') {
                return d;
            }
            return o;
        },

        __refactorClass: function($e, o, c) {
            return $e.filter('.' + o)
                .removeClass(o)
                .addClass(objc[c]);
        },

        __findAddBack: function($e, s) {
            return $e.find(s)
                .add($e.filter(s));
        },

        __filterListItems: function($i) {
            return $i
                .not('.' + objc.divider)
                .not('.' + objc.hidden);
        },

        __transitionend: function($e, fn, duration) {
            var objended = false,
                _fn = function() {
                    if (!objended) {
                        fn.call($e[0]);
                    }
                    objended = true;
                };

            $e.one(obje.transitionend, _fn);
            $e.one(obje.webkitTransitionEnd, _fn);
            setTimeout(_fn, duration * 1.1);
        },

        __getUniqueId: function() {
            return objc.mm($[SLIDEMENU].uniqueId++);
        }
    };


    /** jQuery plugin **/

    $.fn[SLIDEMENU] = function(opts, conf) {
        //	First time plugin is fired
        initPlugin();

        //	Extend options
        opts = $.extend(true, {}, $[SLIDEMENU].defaults, opts);
        conf = $.extend(true, {}, $[SLIDEMENU].configuration, conf);

        return this.each(
            function() {
                var $menu = $(this);
                if ($menu.data(SLIDEMENU)) {
                    return;
                }
                var _menu = new $[SLIDEMENU]($menu, opts, conf);
                $menu.data(SLIDEMENU, _menu.__api());
            }
        );
    };


    /** SUPPORT **/
    $[SLIDEMENU].support = {
        touch: 'ontouchstart' in window || navigator.msMaxTouchPoints
    };

    //	Global variables
    var objc, objd, obje, glbl;

    function initPlugin() {
        if ($[SLIDEMENU].glbl) {
            return;
        }

        glbl = {
            $wndw: $(window),
            $html: $('html'),
            $body: $('body')
        };


        //	Classnames, Datanames, Eventnames
        objc = {};
        objd = {};
        obje = {};
        $.each([objc, objd, obje],
            function(i, o) {
                o.add = function(a) {
                    a = a.split(' ');
                    for (var b = 0, l = a.length; b < l; b++) {
                        o[a[b]] = o.mm(a[b]);
                    }
                };
            }
        );

        //	Classnames
        objc.mm = function(c) {
            return 'ml-' + c;
        };
        objc.add('wrapper menu panel nopanel current highest opened subopened slidemenu hasslidemenu navtitle btn prev next listview nolistview inset vertical selected divider spacer hidden fullsubopen');
        objc.umm = function(c) {
            if (c.slice(0, 3) == 'ml-') {
                c = c.slice(3);
            }
            return c;
        };

        //	Datanames
        objd.mm = function(d) {
            return 'ml-' + d;
        };
        objd.add('parent sub');

        //	Eventnames
        obje.mm = function(e) {
            return e + '.mm';
        };
        obje.add('transitionend webkitTransitionEnd mousedown mouseup touchstart touchmove touchend click keydown');

        $[SLIDEMENU].objc = objc;
        $[SLIDEMENU].objd = objd;
        $[SLIDEMENU].obje = obje;

        $[SLIDEMENU].glbl = glbl;
    }

    $[SLIDEMENU].addons[_ADDON_] = {

        //	setup: fired once per menu
        setup: function() {
            if (!this.opts[_ADDON_]) {
                return;
            }

            var that = this,
                opts = this.opts[_ADDON_],
                conf = this.conf[_ADDON_];

            glbl = $[SLIDEMENU].glbl;


            //	Add methods to api
            this._api = $.merge(this._api, ['open', 'close', 'setPage']);


            //	Debug positioning
            if (opts.position == 'top' || opts.position == 'bottom') {
                opts.zposition = 'front';
            }


            //	Extend configuration
            if (typeof conf.pageSelector != 'string') {
                conf.pageSelector = '> ' + conf.pageNodetype;
            }


            glbl.$allMenus = (glbl.$allMenus || $())
                .add(this.$menu);


            //	Setup the menu
            this.vars.opened = false;

            var clsn = [objc.offcanvas];

            if (opts.position != 'left') {
                clsn.push(objc.mm(opts.position));
            }
            if (opts.zposition != 'back') {
                clsn.push(objc.mm(opts.zposition));
            }

            this.$menu
                .addClass(clsn.join(' '))
                .parent()
                .removeClass(objc.wrapper);


            //	Setup the page
            this.setPage(glbl.$page);


            //	Setup the UI blocker and the window
            this._initBlocker();
            this['_initWindow_' + _ADDON_]();


            //	Append to the body
            this.$menu[conf.menuInjectMethod + 'To'](conf.menuWrapperSelector);
        },

        //	add: fired once per page load
        add: function() {
            objc = $[SLIDEMENU].objc;
            objd = $[SLIDEMENU].objd;
            obje = $[SLIDEMENU].obje;

            objc.add('offcanvas slideout modal background opening blocker page');
            objd.add('style');
            obje.add('resize');
        },

        //	clickAnchor: prevents default behavior when clicking an anchor
        clickAnchor: function($a, inMenu) {
            if (!this.opts[_ADDON_]) {
                return false;
            }

            //	Open menu
            var id = this.$menu.attr('id');
            if (id && id.length) {
                if (this.conf.clone) {
                    id = objc.umm(id);
                }
                if ($a.is('[href="#' + id + '"]')) {
                    this.open();
                    return true;
                }
            }

            //	Close menu
            if (!glbl.$page) {
                return;
            }
            var id = glbl.$page.first()
                .attr('id');
            if (id && id.length) {
                if ($a.is('[href="#' + id + '"]')) {
                    this.close();
                    return true;
                }
            }

            return false;
        }
    };


    //	Default options and configuration
    $[SLIDEMENU].defaults[_ADDON_] = {
        position: 'left',
        zposition: 'back',
        modal: false,
        moveBackground: true
    };
    $[SLIDEMENU].configuration[_ADDON_] = {
        pageNodetype: 'div',
        pageSelector: null,
        wrapPageIfNeeded: true,
        menuWrapperSelector: 'body',
        menuInjectMethod: 'prepend'
    };


    //	Methods
    $[SLIDEMENU].prototype.open = function() {
        if (this.vars.opened) {
            return;
        }

        var that = this;

        this._openSetup();

        //	Without the timeout, the animation won't work because the element had display: none;
        setTimeout(
            function() {
                that._openFinish();
            }, this.conf.openingInterval
        );
        this.trigger('open');
    };

    $[SLIDEMENU].prototype._openSetup = function() {
        var that = this;

        //	Close other menus
        this.closeAllOthers();

        //	Store style and position
        glbl.$page.each(
            function() {
                $(this).data(objd.style, $(this)
                        .attr('style') || '');
            }
        );

        //	Trigger window-resize to measure height
        glbl.$wndw.trigger(obje.resize + '-offcanvas', [true]);

        var clsn = [objc.opened];

        //	Add options
        if (this.opts[_ADDON_].modal) {
            clsn.push(objc.modal);
        }
        if (this.opts[_ADDON_].moveBackground) {
            clsn.push(objc.background);
        }
        if (this.opts[_ADDON_].position != 'left') {
            clsn.push(objc.mm(this.opts[_ADDON_].position));
        }
        if (this.opts[_ADDON_].zposition != 'back') {
            clsn.push(objc.mm(this.opts[_ADDON_].zposition));
        }
        if (this.opts.extensions) {
            clsn.push(this.opts.extensions);
        }
        glbl.$html.addClass(clsn.join(' '));

        //	Open
        setTimeout(function() {
            that.vars.opened = true;
        }, this.conf.openingInterval);

        this.$menu.addClass(objc.current + ' ' + objc.opened);
    };

    $[SLIDEMENU].prototype._openFinish = function() {
        var that = this;

        //	Callback
        this.__transitionend(glbl.$page.first(),
            function() {
                that.trigger('opened');
            }, this.conf.transitionDuration
        );

        //	Opening
        glbl.$html.addClass(objc.opening);
        this.trigger('opening');
    };

    $[SLIDEMENU].prototype.close = function() {
        if (!this.vars.opened) {
            return;
        }

        var that = this;

        //	Callback
        this.__transitionend(glbl.$page.first(),
            function() {
                that.$menu.removeClass(objc.current).removeClass(objc.opened);

                glbl.$html.removeClass(objc.opened).removeClass(objc.modal).removeClass(objc.background).removeClass(objc.mm(that.opts[_ADDON_].position)).removeClass(objc.mm(that.opts[_ADDON_].zposition));

                if (that.opts.extensions) {
                    glbl.$html.removeClass(that.opts.extensions);
                }

                //	Restore style and position
                glbl.$page.each(
                    function() {
                        $(this).attr('style', $(this)
                                .data(objd.style));
                    }
                );

                that.vars.opened = false;
                that.trigger('closed');

            }, this.conf.transitionDuration
        );

        //	Closing
        glbl.$html.removeClass(objc.opening);
        this.trigger('close');
        this.trigger('closing');
    };

    $[SLIDEMENU].prototype.closeAllOthers = function() {
        glbl.$allMenus
            .not(this.$menu)
            .each(
                function() {
                    var api = $(this)
                        .data(SLIDEMENU);
                    if (api && api.close) {
                        api.close();
                    }
                }
            );
    }

    $[SLIDEMENU].prototype.setPage = function($page) {
        var that = this,
            conf = this.conf[_ADDON_];

        if (!$page || !$page.length) {
            $page = glbl.$body.find(conf.pageSelector);
            if ($page.length > 1 && conf.wrapPageIfNeeded) {
                $page = $page.wrapAll('<' + this.conf[_ADDON_].pageNodetype + ' />').parent();
            }
        }

        $page.each(
            function() {
                $(this).attr('id', $(this)
                        .attr('id') || that.__getUniqueId());
            }
        );
        $page.addClass(objc.page + ' ' + objc.slideout);
        glbl.$page = $page;

        this.trigger('setPage', $page);
    };

    $[SLIDEMENU].prototype['_initWindow_' + _ADDON_] = function() {
        //	Prevent tabbing
        glbl.$wndw
            .off(obje.keydown + '-offcanvas')
            .on(obje.keydown + '-offcanvas',
                function(e) {
                    if (glbl.$html.hasClass(objc.opened)) {
                        if (e.keyCode == 9) {
                            e.preventDefault();
                            return false;
                        }
                    }
                }
            );

        //	Set page min-height to window height
        var _h = 0;
        glbl.$wndw
            .off(obje.resize + '-offcanvas')
            .on(obje.resize + '-offcanvas',
                function(e, force) {
                    if (glbl.$page.length == 1) {
                        if (force || glbl.$html.hasClass(objc.opened)) {
                            var nh = glbl.$wndw.height();
                            if (force || nh != _h) {
                                _h = nh;
                                glbl.$page.css('minHeight', nh);
                            }
                        }
                    }
                }
            );
    };

    $[SLIDEMENU].prototype._initBlocker = function() {
        var that = this;

        if (!glbl.$blck) {
            glbl.$blck = $('<div id="' + objc.blocker + '" class="' + objc.slideout + '" />');
        }

        glbl.$blck
            .appendTo(glbl.$body)
            .off(obje.touchstart + '-offcanvas ' + obje.touchmove + '-offcanvas')
            .on(obje.touchstart + '-offcanvas ' + obje.touchmove + '-offcanvas',
                function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    glbl.$blck.trigger(obje.mousedown + '-offcanvas');
                }
            )
            .off(obje.mousedown + '-offcanvas')
            .on(obje.mousedown + '-offcanvas',
                function(e) {
                    e.preventDefault();
                    if (!glbl.$html.hasClass(objc.modal)) {
                        that.closeAllOthers();
                        that.close();
                    }
                }
            );
    };

    var objc, objd, obje, glbl;

})(jQuery);