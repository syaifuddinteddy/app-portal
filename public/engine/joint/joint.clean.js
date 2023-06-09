/*! JointJS v0.9.3 - JavaScript diagramming library  2015-05-22 


 This Source Code Form is subject to the terms of the Mozilla Public
 License, v. 2.0. If a copy of the MPL was not distributed with this
 file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
var joint = {
    version: "0.9.3",
    dia: {},
    ui: {},
    layout: {},
    shapes: {},
    format: {},
    connectors: {},
    routers: {},
    util: {
        hashCode: function (a) {
            var b = 0;
            if (0 == a.length)return b;
            for (var c = 0; c < a.length; c++) {
                var d = a.charCodeAt(c);
                b = (b << 5) - b + d, b &= b
            }
            return b
        }, getByPath: function (a, b, c) {
            c = c || ".";
            for (var d, e = b.split(c); e.length;) {
                if (d = e.shift(), !(Object(a) === a && d in a))return void 0;
                a = a[d]
            }
            return a
        }, setByPath: function (a, b, c, d) {
            d = d || ".";
            var e = b.split(d), f = a, g = 0;
            if (b.indexOf(d) > -1) {
                for (var h = e.length; h - 1 > g; g++)f = f[e[g]] || (f[e[g]] = {});
                f[e[h - 1]] = c
            } else a[b] = c;
            return a
        }, unsetByPath: function (a, b, c) {
            c = c || ".";
            var d = b.lastIndexOf(c);
            if (d > -1) {
                var e = joint.util.getByPath(a, b.substr(0, d), c);
                e && delete e[b.slice(d + 1)]
            } else delete a[b];
            return a
        }, flattenObject: function (a, b, c) {
            b = b || ".";
            var d = {};
            for (var e in a)if (a.hasOwnProperty(e)) {
                var f = "object" == typeof a[e];
                if (f && c && c(a[e]) && (f = !1), f) {
                    var g = this.flattenObject(a[e], b, c);
                    for (var h in g)g.hasOwnProperty(h) && (d[e + b + h] = g[h])
                } else d[e] = a[e]
            }
            return d
        }, uuid: function () {
            return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (a) {
                var b = 16 * Math.random() | 0, c = "x" == a ? b : 3 & b | 8;
                return c.toString(16)
            })
        }, guid: function (a) {
            return this.guid.id = this.guid.id || 1, a.id = void 0 === a.id ? "j_" + this.guid.id++ : a.id, a.id
        }, mixin: function () {
            for (var a = arguments[0], b = 1, c = arguments.length; c > b; b++) {
                var d = arguments[b];
                (Object(d) === d || _.isFunction(d) || null !== d && void 0 !== d) && _.each(d, function (b, c) {
                    return this.mixin.deep && Object(b) === b ? (a[c] || (a[c] = _.isArray(b) ? [] : {}), void this.mixin(a[c], b)) : void(a[c] !== b && (this.mixin.supplement && a.hasOwnProperty(c) || (a[c] = b)))
                }, this)
            }
            return a
        }, supplement: function () {
            this.mixin.supplement = !0;
            var a = this.mixin.apply(this, arguments);
            return this.mixin.supplement = !1, a
        }, deepMixin: function () {
            this.mixin.deep = !0;
            var a = this.mixin.apply(this, arguments);
            return this.mixin.deep = !1, a
        }, deepSupplement: function () {
            this.mixin.deep = this.mixin.supplement = !0;
            var a = this.mixin.apply(this, arguments);
            return this.mixin.deep = this.mixin.supplement = !1, a
        }, normalizeEvent: function (a) {
            return a.originalEvent && a.originalEvent.changedTouches && a.originalEvent.changedTouches.length ? a.originalEvent.changedTouches[0] : a
        }, nextFrame: function () {
            var a, b = "undefined" != typeof window;
            if (b && (a = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame), !a) {
                var c = 0;
                a = function (a) {
                    var b = (new Date).getTime(), d = Math.max(0, 16 - (b - c)), e = setTimeout(function () {
                        a(b + d)
                    }, d);
                    return c = b + d, e
                }
            }
            return b ? _.bind(a, window) : a
        }(), cancelFrame: function () {
            var a, b = "undefined" != typeof window;
            return b && (a = window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.webkitCancelRequestAnimationFrame || window.msCancelAnimationFrame || window.msCancelRequestAnimationFrame || window.oCancelAnimationFrame || window.oCancelRequestAnimationFrame || window.mozCancelAnimationFrame || window.mozCancelRequestAnimationFrame), a = a || clearTimeout, b ? _.bind(a, window) : a
        }(), shapePerimeterConnectionPoint: function (a, b, c, d) {
            var e, f;
            if (!c) {
                var h = b.$(".scalable")[0], i = b.$(".rotatable")[0];
                h && h.firstChild ? c = h.firstChild : i && i.firstChild && (c = i.firstChild)
            }
            return c ? (f = V(c).findIntersection(d, a.paper.viewport), f || (e = g.rect(V(c).bbox(!1, a.paper.viewport)))) : (e = b.model.getBBox(), f = e.intersectionWithLineFromCenterToPoint(d)), f || e.center()
        }, breakText: function (a, b, c, d) {
            d = d || {};
            var e = b.width, f = b.height, g = d.svgDocument || V("svg").node, h = V("<text><tspan></tspan></text>").attr(c || {}).node, i = h.firstChild, j = document.createTextNode("");
            i.appendChild(j), g.appendChild(h), d.svgDocument || document.body.appendChild(g);
            for (var k, l = a.split(" "), m = [], n = [], o = 0, p = 0, q = l.length; q > o; o++) {
                var r = l[o];
                if (j.data = n[p] ? n[p] + " " + r : r, i.getComputedTextLength() <= e)n[p] = j.data, k && (m[p++] = !0, k = 0); else {
                    if (!n[p] || k) {
                        var s = !!k;
                        if (k = r.length - 1, s || !k) {
                            if (!k) {
                                if (!n[p]) {
                                    n = [];
                                    break
                                }
                                l.splice(o, 2, r + l[o + 1]), q--, m[p++] = !0, o--;
                                continue
                            }
                            l[o] = r.substring(0, k), l[o + 1] = r.substring(k) + l[o + 1]
                        } else l.splice(o, 1, r.substring(0, k), r.substring(k)), q++, p && !m[p - 1] && p--;
                        o--;
                        continue
                    }
                    p++, o--
                }
                if ("undefined" != typeof f) {
                    var t = t || 1.25 * h.getBBox().height;
                    if (t * n.length > f) {
                        n.splice(Math.floor(f / t));
                        break
                    }
                }
            }
            return d.svgDocument ? g.removeChild(h) : document.body.removeChild(g), n.join("\n")
        }, imageToDataUri: function (a, b) {
            if (!a || "data:" === a.substr(0, "data:".length))return setTimeout(function () {
                b(null, a)
            }, 0);
            var c = document.createElement("canvas"), d = document.createElement("img");
            d.onload = function () {
                var e = c.getContext("2d");
                c.width = d.width, c.height = d.height, e.drawImage(d, 0, 0);
                try {
                    var f = (a.split(".").pop() || "png", "jpeg"), g = c.toDataURL(f)
                } catch (h) {
                    if (/\.svg$/.test(a)) {
                        var i = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject("Microsoft.XMLHTTP");
                        i.open("GET", a, !1), i.send(null);
                        var j = i.responseText;
                        return b(null, "data:image/svg+xml," + encodeURIComponent(j))
                    }
                    console.error(d.src, "fails to convert", h)
                }
                b(null, g)
            }, d.ononerror = function () {
                b(new Error("Failed to load image."))
            }, d.src = a
        }, timing: {
            linear: function (a) {
                return a
            }, quad: function (a) {
                return a * a
            }, cubic: function (a) {
                return a * a * a
            }, inout: function (a) {
                if (0 >= a)return 0;
                if (a >= 1)return 1;
                var b = a * a, c = b * a;
                return 4 * (.5 > a ? c : 3 * (a - b) + c - .75)
            }, exponential: function (a) {
                return Math.pow(2, 10 * (a - 1))
            }, bounce: function (a) {
                for (var b = 0, c = 1; 1; b += c, c /= 2)if (a >= (7 - 4 * b) / 11) {
                    var d = (11 - 6 * b - 11 * a) / 4;
                    return -d * d + c * c
                }
            }, reverse: function (a) {
                return function (b) {
                    return 1 - a(1 - b)
                }
            }, reflect: function (a) {
                return function (b) {
                    return .5 * (.5 > b ? a(2 * b) : 2 - a(2 - 2 * b))
                }
            }, clamp: function (a, b, c) {
                return b = b || 0, c = c || 1, function (d) {
                    var e = a(d);
                    return b > e ? b : e > c ? c : e
                }
            }, back: function (a) {
                return a || (a = 1.70158), function (b) {
                    return b * b * ((a + 1) * b - a)
                }
            }, elastic: function (a) {
                return a || (a = 1.5), function (b) {
                    return Math.pow(2, 10 * (b - 1)) * Math.cos(20 * Math.PI * a / 3 * b)
                }
            }
        }, interpolate: {
            number: function (a, b) {
                var c = b - a;
                return function (b) {
                    return a + c * b
                }
            }, object: function (a, b) {
                var c = _.keys(a);
                return function (d) {
                    var e, f, g = {};
                    for (e = c.length - 1; -1 != e; e--)f = c[e], g[f] = a[f] + (b[f] - a[f]) * d;
                    return g
                }
            }, hexColor: function (a, b) {
                var c = parseInt(a.slice(1), 16), d = parseInt(b.slice(1), 16), e = 255 & c, f = (255 & d) - e, g = 65280 & c, h = (65280 & d) - g, i = 16711680 & c, j = (16711680 & d) - i;
                return function (a) {
                    var b = e + f * a & 255, c = g + h * a & 65280, d = i + j * a & 16711680;
                    return "#" + (1 << 24 | b | c | d).toString(16).slice(1)
                }
            }, unit: function (a, b) {
                var c = /(-?[0-9]*.[0-9]*)(px|em|cm|mm|in|pt|pc|%)/, d = c.exec(a), e = c.exec(b), f = e[1].indexOf("."), g = f > 0 ? e[1].length - f - 1 : 0;
                a = +d[1];
                var h = +e[1] - a, i = d[2];
                return function (b) {
                    return (a + h * b).toFixed(g) + i
                }
            }
        }, filter: {
            blur: function (a) {
                var b = _.isFinite(a.x) ? a.x : 2;
                return _.template('<filter><feGaussianBlur stdDeviation="${stdDeviation}"/></filter>', {stdDeviation: _.isFinite(a.y) ? [b, a.y] : b})
            }, dropShadow: function (a) {
                var b = "SVGFEDropShadowElement"in window ? '<filter><feDropShadow stdDeviation="${blur}" dx="${dx}" dy="${dy}" flood-color="${color}" flood-opacity="${opacity}"/></filter>' : '<filter><feGaussianBlur in="SourceAlpha" stdDeviation="${blur}"/><feOffset dx="${dx}" dy="${dy}" result="offsetblur"/><feFlood flood-color="${color}"/><feComposite in2="offsetblur" operator="in"/><feComponentTransfer><feFuncA type="linear" slope="${opacity}"/></feComponentTransfer><feMerge><feMergeNode/><feMergeNode in="SourceGraphic"/></feMerge></filter>';
                return _.template(b, {
                    dx: a.dx || 0,
                    dy: a.dy || 0,
                    opacity: _.isFinite(a.opacity) ? a.opacity : 1,
                    color: a.color || "black",
                    blur: _.isFinite(a.blur) ? a.blur : 4
                })
            }, grayscale: function (a) {
                var b = _.isFinite(a.amount) ? a.amount : 1;
                return _.template('<filter><feColorMatrix type="matrix" values="${a} ${b} ${c} 0 0 ${d} ${e} ${f} 0 0 ${g} ${b} ${h} 0 0 0 0 0 1 0"/></filter>', {
                    a: .2126 + .7874 * (1 - b),
                    b: .7152 - .7152 * (1 - b),
                    c: .0722 - .0722 * (1 - b),
                    d: .2126 - .2126 * (1 - b),
                    e: .7152 + .2848 * (1 - b),
                    f: .0722 - .0722 * (1 - b),
                    g: .2126 - .2126 * (1 - b),
                    h: .0722 + .9278 * (1 - b)
                })
            }, sepia: function (a) {
                var b = _.isFinite(a.amount) ? a.amount : 1;
                return _.template('<filter><feColorMatrix type="matrix" values="${a} ${b} ${c} 0 0 ${d} ${e} ${f} 0 0 ${g} ${h} ${i} 0 0 0 0 0 1 0"/></filter>', {
                    a: .393 + .607 * (1 - b),
                    b: .769 - .769 * (1 - b),
                    c: .189 - .189 * (1 - b),
                    d: .349 - .349 * (1 - b),
                    e: .686 + .314 * (1 - b),
                    f: .168 - .168 * (1 - b),
                    g: .272 - .272 * (1 - b),
                    h: .534 - .534 * (1 - b),
                    i: .131 + .869 * (1 - b)
                })
            }, saturate: function (a) {
                var b = _.isFinite(a.amount) ? a.amount : 1;
                return _.template('<filter><feColorMatrix type="saturate" values="${amount}"/></filter>', {amount: 1 - b})
            }, hueRotate: function (a) {
                return _.template('<filter><feColorMatrix type="hueRotate" values="${angle}"/></filter>', {angle: a.angle || 0})
            }, invert: function (a) {
                var b = _.isFinite(a.amount) ? a.amount : 1;
                return _.template('<filter><feComponentTransfer><feFuncR type="table" tableValues="${amount} ${amount2}"/><feFuncG type="table" tableValues="${amount} ${amount2}"/><feFuncB type="table" tableValues="${amount} ${amount2}"/></feComponentTransfer></filter>', {
                    amount: b,
                    amount2: 1 - b
                })
            }, brightness: function (a) {
                return _.template('<filter><feComponentTransfer><feFuncR type="linear" slope="${amount}"/><feFuncG type="linear" slope="${amount}"/><feFuncB type="linear" slope="${amount}"/></feComponentTransfer></filter>', {amount: _.isFinite(a.amount) ? a.amount : 1})
            }, contrast: function (a) {
                var b = _.isFinite(a.amount) ? a.amount : 1;
                return _.template('<filter><feComponentTransfer><feFuncR type="linear" slope="${amount}" intercept="${amount2}"/><feFuncG type="linear" slope="${amount}" intercept="${amount2}"/><feFuncB type="linear" slope="${amount}" intercept="${amount2}"/></feComponentTransfer></filter>', {
                    amount: b,
                    amount2: .5 - b / 2
                })
            }
        }, format: {
            number: function (a, b, c) {
                function d(a) {
                    for (var b = a.length, d = [], e = 0, f = c.grouping[0]; b > 0 && f > 0;)d.push(a.substring(b -= f, b + f)), f = c.grouping[e = (e + 1) % c.grouping.length];
                    return d.reverse().join(c.thousands)
                }

                c = c || {currency: ["$", ""], decimal: ".", thousands: ",", grouping: [3]};
                var e = /(?:([^{])?([<>=^]))?([+\- ])?([$#])?(0)?(\d+)?(,)?(\.-?\d+)?([a-z%])?/i, f = e.exec(a), g = f[1] || " ", h = f[2] || ">", i = f[3] || "", j = f[4] || "", k = f[5], l = +f[6], m = f[7], n = f[8], o = f[9], p = 1, q = "", r = "", s = !1;
                switch (n && (n = +n.substring(1)), (k || "0" === g && "=" === h) && (k = g = "0", h = "=", m && (l -= Math.floor((l - 1) / 4))), o) {
                    case"n":
                        m = !0, o = "g";
                        break;
                    case"%":
                        p = 100, r = "%", o = "f";
                        break;
                    case"p":
                        p = 100, r = "%", o = "r";
                        break;
                    case"b":
                    case"o":
                    case"x":
                    case"X":
                        "#" === j && (q = "0" + o.toLowerCase());
                    case"c":
                    case"d":
                        s = !0, n = 0;
                        break;
                    case"s":
                        p = -1, o = "r"
                }
                "$" === j && (q = c.currency[0], r = c.currency[1]), "r" != o || n || (o = "g"), null != n && ("g" == o ? n = Math.max(1, Math.min(21, n)) : ("e" == o || "f" == o) && (n = Math.max(0, Math.min(20, n))));
                var t = k && m;
                if (s && b % 1)return "";
                var u = 0 > b || 0 === b && 0 > 1 / b ? (b = -b, "-") : i, v = r;
                if (0 > p) {
                    var w = this.prefix(b, n);
                    b = w.scale(b), v = w.symbol + r
                } else b *= p;
                b = this.convert(o, b, n);
                var x = b.lastIndexOf("."), y = 0 > x ? b : b.substring(0, x), z = 0 > x ? "" : c.decimal + b.substring(x + 1);
                !k && m && c.grouping && (y = d(y));
                var A = q.length + y.length + z.length + (t ? 0 : u.length), B = l > A ? new Array(A = l - A + 1).join(g) : "";
                return t && (y = d(B + y)), u += q, b = y + z, ("<" === h ? u + b + B : ">" === h ? B + u + b : "^" === h ? B.substring(0, A >>= 1) + u + b + B.substring(A) : u + (t ? b : B + b)) + v
            }, string: function (a, b) {
                for (var c, d = "{", e = !1, f = []; -1 !== (c = a.indexOf(d));) {
                    var g, h, i;
                    if (g = a.slice(0, c), e) {
                        h = g.split(":"), i = h.shift().split("."), g = b;
                        for (var j = 0; j < i.length; j++)g = g[i[j]];
                        h.length && (g = this.number(h, g))
                    }
                    f.push(g), a = a.slice(c + 1), d = (e = !e) ? "}" : "{"
                }
                return f.push(a), f.join("")
            }, convert: function (a, b, c) {
                switch (a) {
                    case"b":
                        return b.toString(2);
                    case"c":
                        return String.fromCharCode(b);
                    case"o":
                        return b.toString(8);
                    case"x":
                        return b.toString(16);
                    case"X":
                        return b.toString(16).toUpperCase();
                    case"g":
                        return b.toPrecision(c);
                    case"e":
                        return b.toExponential(c);
                    case"f":
                        return b.toFixed(c);
                    case"r":
                        return (b = this.round(b, this.precision(b, c))).toFixed(Math.max(0, Math.min(20, this.precision(b * (1 + 1e-15), c))));
                    default:
                        return b + ""
                }
            }, round: function (a, b) {
                return b ? Math.round(a * (b = Math.pow(10, b))) / b : Math.round(a)
            }, precision: function (a, b) {
                return b - (a ? Math.ceil(Math.log(a) / Math.LN10) : 1)
            }, prefix: function (a, b) {
                var c = _.map(["y", "z", "a", "f", "p", "n", "µ", "m", "", "k", "M", "G", "T", "P", "E", "Z", "Y"], function (a, b) {
                    var c = Math.pow(10, 3 * abs(8 - b));
                    return {
                        scale: b > 8 ? function (a) {
                            return a / c
                        } : function (a) {
                            return a * c
                        }, symbol: a
                    }
                }), d = 0;
                return a && (0 > a && (a *= -1), b && (a = this.round(a, this.precision(a, b))), d = 1 + Math.floor(1e-12 + Math.log(a) / Math.LN10), d = Math.max(-24, Math.min(24, 3 * Math.floor((0 >= d ? d + 1 : d - 1) / 3)))), c[8 + d / 3]
            }
        }
    }
};
joint.dia.GraphCells = Backbone.Collection.extend({
    initialize: function () {
        this.on("change:z", this.sort, this)
    }, model: function (a, b) {
        if ("link" === a.type)return new joint.dia.Link(a, b);
        var c = a.type.split(".")[0], d = a.type.split(".")[1];
        return joint.shapes[c] && joint.shapes[c][d] ? new joint.shapes[c][d](a, b) : new joint.dia.Element(a, b)
    }, comparator: function (a) {
        return a.get("z") || 0
    }, getConnectedLinks: function (a, b) {
        b = b || {}, _.isUndefined(b.inbound) && _.isUndefined(b.outbound) && (b.inbound = b.outbound = !0);
        var c = this.filter(function (c) {
            var d = c.get("source"), e = c.get("target");
            return d && d.id === a.id && b.outbound || e && e.id === a.id && b.inbound
        });
        if (b.deep) {
            var d = a.getEmbeddedCells({deep: !0});
            _.each(this.difference(c, d), function (a) {
                if (b.outbound) {
                    var e = a.get("source");
                    if (e && e.id && _.find(d, {id: e.id}))return void c.push(a)
                }
                if (b.inbound) {
                    var f = a.get("target");
                    f && f.id && _.find(d, {id: f.id}) && c.push(a)
                }
            })
        }
        return c
    }, getCommonAncestor: function () {
        var a = _.map(arguments, function (a) {
            for (var b = [a.id], c = a.get("parent"); c;)b.push(c), c = this.get(c).get("parent");
            return b
        }, this);
        a = _.sortBy(a, "length");
        var b = _.find(a.shift(), function (b) {
            return _.every(a, function (a) {
                return _.contains(a, b)
            })
        });
        return this.get(b)
    }, getBBox: function (a) {
        a = a || this.models;
        var b = {x: 1 / 0, y: 1 / 0}, c = {x: -(1 / 0), y: -(1 / 0)};
        return _.each(a, function (a) {
            if (!a.isLink()) {
                var d = a.getBBox();
                b.x = Math.min(b.x, d.x), b.y = Math.min(b.y, d.y), c.x = Math.max(c.x, d.x + d.width), c.y = Math.max(c.y, d.y + d.height)
            }
        }), g.rect(b.x, b.y, c.x - b.x, c.y - b.y)
    }
}), joint.dia.Graph = Backbone.Model.extend({
    initialize: function (a, b) {
        this.set("cells", new joint.dia.GraphCells([], {model: b && b.cellModel})), this.get("cells").on("all", this.trigger, this), this.get("cells").on("remove", this.removeCell, this)
    }, toJSON: function () {
        var a = Backbone.Model.prototype.toJSON.apply(this, arguments);
        return a.cells = this.get("cells").toJSON(), a
    }, fromJSON: function (a, b) {
        if (!a.cells)throw new Error("Graph JSON must contain cells array.");
        this.set(_.omit(a, "cells"), b), this.resetCells(a.cells, b)
    }, clear: function (a) {
        this.trigger("batch:start"), this.get("cells").remove(this.get("cells").models, a), this.trigger("batch:stop")
    }, _prepareCell: function (a) {
        return a instanceof Backbone.Model && _.isUndefined(a.get("z")) ? a.set("z", this.maxZIndex() + 1, {silent: !0}) : _.isUndefined(a.z) && (a.z = this.maxZIndex() + 1), a
    }, maxZIndex: function () {
        var a = this.get("cells").last();
        return a ? a.get("z") || 0 : 0
    }, addCell: function (a, b) {
        return _.isArray(a) ? this.addCells(a, b) : (this.get("cells").add(this._prepareCell(a), b || {}), this)
    }, addCells: function (a, b) {
        return b = b || {}, b.position = a.length, _.each(a, function (a) {
            b.position--, this.addCell(a, b)
        }, this), this
    }, resetCells: function (a, b) {
        return this.get("cells").reset(_.map(a, this._prepareCell, this), b), this
    }, removeCell: function (a, b, c) {
        c && c.disconnectLinks ? this.disconnectLinks(a, c) : this.removeLinks(a, c), this.get("cells").remove(a, {silent: !0})
    }, getCell: function (a) {
        return this.get("cells").get(a)
    }, getElements: function () {
        return this.get("cells").filter(function (a) {
            return a instanceof joint.dia.Element
        })
    }, getLinks: function () {
        return this.get("cells").filter(function (a) {
            return a instanceof joint.dia.Link
        })
    }, getConnectedLinks: function (a, b) {
        return this.get("cells").getConnectedLinks(a, b)
    }, getNeighbors: function (a) {
        var b = this.getConnectedLinks(a), c = [], d = this.get("cells");
        return _.each(b, function (b) {
            var e = b.get("source"), f = b.get("target");
            if (!e.x) {
                var g = d.get(e.id);
                g !== a && c.push(g)
            }
            if (!f.x) {
                var h = d.get(f.id);
                h !== a && c.push(h)
            }
        }), c
    }, disconnectLinks: function (a, b) {
        _.each(this.getConnectedLinks(a), function (c) {
            c.set(c.get("source").id === a.id ? "source" : "target", g.point(0, 0), b)
        })
    }, removeLinks: function (a, b) {
        _.invoke(this.getConnectedLinks(a), "remove", b)
    }, findModelsFromPoint: function (a) {
        return _.filter(this.getElements(), function (b) {
            return b.getBBox().containsPoint(a)
        })
    }, findModelsInArea: function (a) {
        return _.filter(this.getElements(), function (b) {
            return b.getBBox().intersect(a)
        })
    }, getBBox: function () {
        var a = this.get("cells");
        return a.getBBox.apply(a, arguments)
    }, getCommonAncestor: function () {
        var a = this.get("cells");
        return a.getCommonAncestor.apply(a, arguments)
    }
}), joint.dia.Cell = Backbone.Model.extend({
    constructor: function (a, b) {
        var c, d = a || {};
        this.cid = _.uniqueId("c"), this.attributes = {}, b && b.collection && (this.collection = b.collection), b && b.parse && (d = this.parse(d, b) || {}), (c = _.result(this, "defaults")) && (d = _.merge({}, c, d)), this.set(d, b), this.changed = {}, this.initialize.apply(this, arguments)
    }, toJSON: function () {
        var a = this.constructor.prototype.defaults.attrs || {}, b = this.attributes.attrs, c = {};
        _.each(b, function (b, d) {
            var e = a[d];
            _.each(b, function (a, b) {
                _.isObject(a) && !_.isArray(a) ? _.each(a, function (a, f) {
                    e && e[b] && _.isEqual(e[b][f], a) || (c[d] = c[d] || {}, (c[d][b] || (c[d][b] = {}))[f] = a)
                }) : e && _.isEqual(e[b], a) || (c[d] = c[d] || {}, c[d][b] = a)
            })
        });
        var d = _.cloneDeep(_.omit(this.attributes, "attrs"));
        return d.attrs = c, d
    }, initialize: function (a) {
        a && a.id || this.set("id", joint.util.uuid(), {silent: !0}), this._transitionIds = {}, this.processPorts(), this.on("change:attrs", this.processPorts, this)
    }, processPorts: function () {
        var a = this.ports, b = {};
        _.each(this.get("attrs"), function (a, c) {
            a && a.port && (_.isUndefined(a.port.id) ? b[a.port] = {id: a.port} : b[a.port.id] = a.port)
        });
        var c = {};
        if (_.each(a, function (a, d) {
                b[d] || (c[d] = !0)
            }), this.collection && !_.isEmpty(c)) {
            var d = this.collection.getConnectedLinks(this, {inbound: !0});
            _.each(d, function (a) {
                c[a.get("target").port] && a.remove()
            });
            var e = this.collection.getConnectedLinks(this, {outbound: !0});
            _.each(e, function (a) {
                c[a.get("source").port] && a.remove()
            })
        }
        this.ports = b
    }, remove: function (a) {
        a = a || {};
        var b = this.collection;
        b && b.trigger("batch:start", {batchName: "remove"});
        var c = this.get("parent");
        if (c) {
            var d = this.collection && this.collection.get(c);
            d.unembed(this)
        }
        return _.invoke(this.getEmbeddedCells(), "remove", a), this.trigger("remove", this, this.collection, a), b && b.trigger("batch:stop", {batchName: "remove"}), this
    }, toFront: function (a) {
        if (this.collection) {
            a = a || {};
            var b = (this.collection.last().get("z") || 0) + 1;
            if (this.trigger("batch:start", {batchName: "to-front"}).set("z", b, a), a.deep) {
                var c = this.getEmbeddedCells({deep: !0, breadthFirst: !0});
                _.each(c, function (c) {
                    c.set("z", ++b, a)
                })
            }
            this.trigger("batch:stop", {batchName: "to-front"})
        }
        return this
    }, toBack: function (a) {
        if (this.collection) {
            a = a || {};
            var b = (this.collection.first().get("z") || 0) - 1;
            if (this.trigger("batch:start", {batchName: "to-back"}), a.deep) {
                var c = this.getEmbeddedCells({deep: !0, breadthFirst: !0});
                _.eachRight(c, function (c) {
                    c.set("z", b--, a)
                })
            }
            this.set("z", b, a).trigger("batch:stop", {batchName: "to-back"})
        }
        return this
    }, embed: function (a, b) {
        if (this == a || this.isEmbeddedIn(a))throw new Error("Recursive embedding not allowed.");
        this.trigger("batch:start", {batchName: "embed"});
        var c = _.clone(this.get("embeds") || []);
        return c[a.isLink() ? "unshift" : "push"](a.id), a.set("parent", this.id, b), this.set("embeds", _.uniq(c), b), this.trigger("batch:stop", {batchName: "embed"}), this
    }, unembed: function (a, b) {
        return this.trigger("batch:start", {batchName: "unembed"}), a.unset("parent", b), this.set("embeds", _.without(this.get("embeds"), a.id), b), this.trigger("batch:stop", {batchName: "unembed"}), this
    }, getAncestors: function () {
        var a = [], b = this.get("parent");
        if (void 0 === this.collection)return a;
        for (; void 0 !== b;) {
            var c = this.collection.get(b);
            if (void 0 === c)break;
            a.push(c), b = c.get("parent")
        }
        return a
    }, getEmbeddedCells: function (a) {
        if (a = a || {}, this.collection) {
            var b;
            if (a.deep)if (a.breadthFirst) {
                b = [];
                for (var c = this.getEmbeddedCells(); c.length > 0;) {
                    var d = c.shift();
                    b.push(d), c.push.apply(c, d.getEmbeddedCells())
                }
            } else b = this.getEmbeddedCells(), _.each(b, function (c) {
                b.push.apply(b, c.getEmbeddedCells(a))
            }); else b = _.map(this.get("embeds"), this.collection.get, this.collection);
            return b
        }
        return []
    }, isEmbeddedIn: function (a, b) {
        var c = _.isString(a) ? a : a.id, d = this.get("parent");
        if (b = _.defaults({deep: !0}, b), this.collection && b.deep) {
            for (; d;) {
                if (d == c)return !0;
                d = this.collection.get(d).get("parent")
            }
            return !1
        }
        return d == c
    }, clone: function (a) {
        a = a || {};
        var b = Backbone.Model.prototype.clone.apply(this, arguments);
        if (b.set("id", joint.util.uuid(), {silent: !0}), b.set("embeds", ""), !a.deep)return b;
        var c = _.sortBy(this.getEmbeddedCells(), function (a) {
            return a instanceof joint.dia.Element
        }), d = [b], e = {};
        return _.each(c, function (a) {
            var c = a.clone({deep: !0});
            b.embed(c[0]), _.each(c, function (c) {
                if (c instanceof joint.dia.Link)return c.get("source").id == this.id && c.prop("source", {id: b.id}), c.get("target").id == this.id && c.prop("target", {id: b.id}), void(e[a.id] = c);
                d.push(c);
                var f = this.collection.getConnectedLinks(a, {inbound: !0});
                _.each(f, function (a) {
                    var b = e[a.id] || a.clone();
                    e[a.id] = b, b.prop("target", {id: c.id})
                });
                var g = this.collection.getConnectedLinks(a, {outbound: !0});
                _.each(g, function (a) {
                    var b = e[a.id] || a.clone();
                    e[a.id] = b, b.prop("source", {id: c.id})
                })
            }, this)
        }, this), d = d.concat(_.values(e))
    }, prop: function (a, b, c) {
        var d = "/";
        if (_.isString(a)) {
            if (arguments.length > 1) {
                var e = a, f = e.split("/"), g = f[0];
                if (c = c || {}, c.propertyPath = e, c.propertyValue = b, 1 == f.length)return this.set(g, b, c);
                var h = {}, i = h, j = g;
                _.each(_.rest(f), function (a) {
                    i = i[j] = _.isFinite(Number(a)) ? [] : {}, j = a
                }), h = joint.util.setByPath(h, e, b, "/");
                var k = _.merge({}, this.attributes);
                c.rewrite && joint.util.unsetByPath(k, e, "/");
                var l = _.merge(k, h);
                return this.set(g, l[g], c)
            }
            return joint.util.getByPath(this.attributes, a, d)
        }
        return this.set(_.merge({}, this.attributes, a), b)
    }, removeProp: function (a, b) {
        b = b || {}, b.dirty = !0;
        var c = a.split("/");
        if (1 === c.length)return this.unset(a, b);
        var d = c[0], e = c.slice(1).join("/"), f = _.merge({}, this.get(d));
        return joint.util.unsetByPath(f, e, "/"), this.set(d, f, b)
    }, attr: function (a, b, c) {
        var d = Array.prototype.slice.call(arguments);
        return d[0] = _.isString(a) ? "attrs/" + a : {attrs: a}, this.prop.apply(this, d)
    }, removeAttr: function (a, b) {
        return _.isArray(a) ? (_.each(a, function (a) {
            this.removeAttr(a, b)
        }, this), this) : this.removeProp("attrs/" + a, b)
    }, transition: function (a, b, c, d) {
        d = d || "/";
        var e = {
            duration: 100,
            delay: 10,
            timingFunction: joint.util.timing.linear,
            valueFunction: joint.util.interpolate.number
        };
        c = _.extend(e, c);
        var f, g = 0, h = _.bind(function (b) {
            var d, e, i;
            g = g || b, b -= g, e = b / c.duration, 1 > e ? this._transitionIds[a] = d = joint.util.nextFrame(h) : (e = 1, delete this._transitionIds[a]), i = f(c.timingFunction(e)), c.transitionId = d, this.prop(a, i, c), d || this.trigger("transition:end", this, a)
        }, this), i = _.bind(function (e) {
            this.stopTransitions(a), f = c.valueFunction(joint.util.getByPath(this.attributes, a, d), b), this._transitionIds[a] = joint.util.nextFrame(e), this.trigger("transition:start", this, a)
        }, this);
        return _.delay(i, c.delay, h)
    }, getTransitions: function () {
        return _.keys(this._transitionIds)
    }, stopTransitions: function (a, b) {
        b = b || "/";
        var c = a && a.split(b);
        return _(this._transitionIds).keys().filter(c && function (a) {
            return _.isEqual(c, a.split(b).slice(0, c.length))
        }).each(function (a) {
            joint.util.cancelFrame(this._transitionIds[a]), delete this._transitionIds[a], this.trigger("transition:end", this, a)
        }, this), this
    }, addTo: function (a, b) {
        return a.addCell(this, b), this
    }, findView: function (a) {
        return a.findViewByModel(this)
    }, isLink: function () {
        return !1
    }
}), joint.dia.CellView = Backbone.View.extend({
    tagName: "g", attributes: function () {
        return {"model-id": this.model.id}
    }, constructor: function (a) {
        this._configure(a), Backbone.View.apply(this, arguments)
    }, _configure: function (a) {
        this.options && (a = _.extend({}, _.result(this, "options"), a)), this.options = a, this.options.id = this.options.id || joint.util.guid(this)
    }, initialize: function () {
        _.bindAll(this, "remove", "update"), this.$el.data("view", this), this.listenTo(this.model, "remove", this.remove), this.listenTo(this.model, "change:attrs", this.onChangeAttrs)
    }, onChangeAttrs: function (a, b, c) {
        return c.dirty ? this.render() : this.update()
    }, _ensureElement: function () {
        var a;
        if (this.el)a = _.result(this, "el"); else {
            var b = _.extend({id: this.id}, _.result(this, "attributes"));
            this.className && (b["class"] = _.result(this, "className")), a = V(_.result(this, "tagName"), b).node
        }
        this.setElement(a, !1)
    }, findBySelector: function (a) {
        var b = "." === a ? this.$el : this.$el.find(a);
        return b
    }, notify: function (a) {
        if (this.paper) {
            var b = Array.prototype.slice.call(arguments, 1);
            this.trigger.apply(this, [a].concat(b)), this.paper.trigger.apply(this.paper, [a, this].concat(b))
        }
    }, getStrokeBBox: function (a) {
        var b = !!a;
        a = a || this.el;
        var c, d = V(a).bbox(!1, this.paper.viewport);
        return c = b ? V(a).attr("stroke-width") : this.model.attr("rect/stroke-width") || this.model.attr("circle/stroke-width") || this.model.attr("ellipse/stroke-width") || this.model.attr("path/stroke-width"), c = parseFloat(c) || 0, g.rect(d).moveAndExpand({
            x: -c / 2,
            y: -c / 2,
            width: c,
            height: c
        })
    }, getBBox: function () {
        return V(this.el).bbox()
    }, highlight: function (a, b) {
        return a = a ? this.$(a)[0] || this.el : this.el, b = b || {}, b.partial = a != this.el, this.notify("cell:highlight", a, b), this
    }, unhighlight: function (a, b) {
        return a = a ? this.$(a)[0] || this.el : this.el, b = b || {}, b.partial = a != this.el, this.notify("cell:unhighlight", a, b), this
    }, findMagnet: function (a) {
        var b = this.$(a);
        if (0 === b.length || b[0] === this.el) {
            var c = this.model.get("attrs") || {};
            return c["."] && c["."].magnet === !1 ? void 0 : this.el
        }
        return b.attr("magnet") ? b[0] : this.findMagnet(b.parent())
    }, applyFilter: function (a, b) {
        var c = this.findBySelector(a), d = b.name + this.paper.svg.id + joint.util.hashCode(JSON.stringify(b));
        if (!this.paper.svg.getElementById(d)) {
            var e = joint.util.filter[b.name] && joint.util.filter[b.name](b.args || {});
            if (!e)throw new Error("Non-existing filter " + b.name);
            var f = V(e);
            f.attr({
                filterUnits: "objectBoundingBox",
                x: -1,
                y: -1,
                width: 3,
                height: 3
            }), b.attrs && f.attr(b.attrs), f.node.id = d, V(this.paper.svg).defs().append(f)
        }
        c.each(function () {
            V(this).attr("filter", "url(#" + d + ")")
        })
    }, applyGradient: function (a, b, c) {
        var d = this.findBySelector(a), e = c.type + this.paper.svg.id + joint.util.hashCode(JSON.stringify(c));
        if (!this.paper.svg.getElementById(e)) {
            var f = ["<" + c.type + ">", _.map(c.stops, function (a) {
                return '<stop offset="' + a.offset + '" stop-color="' + a.color + '" stop-opacity="' + (_.isFinite(a.opacity) ? a.opacity : 1) + '" />'
            }).join(""), "</" + c.type + ">"].join(""), g = V(f);
            c.attrs && g.attr(c.attrs), g.node.id = e, V(this.paper.svg).defs().append(g)
        }
        d.each(function () {
            V(this).attr(b, "url(#" + e + ")")
        })
    }, getSelector: function (a, b) {
        if (a === this.el)return b;
        var c = V(a).index() + 1, d = a.tagName + ":nth-child(" + c + ")";
        return b && (d += " > " + b), this.getSelector(a.parentNode, d)
    }, pointerdblclick: function (a, b, c) {
        this.notify("cell:pointerdblclick", a, b, c)
    }, pointerclick: function (a, b, c) {
        this.notify("cell:pointerclick", a, b, c)
    }, pointerdown: function (a, b, c) {
        this.model.collection && (this.model.trigger("batch:start", {batchName: "pointer"}), this._collection = this.model.collection), this.notify("cell:pointerdown", a, b, c)
    }, pointermove: function (a, b, c) {
        this.notify("cell:pointermove", a, b, c)
    }, pointerup: function (a, b, c) {
        this.notify("cell:pointerup", a, b, c), this._collection && (this._collection.trigger("batch:stop", {batchName: "pointer"}), delete this._collection)
    }, mouseover: function (a) {
        this.notify("cell:mouseover", a)
    }, mouseout: function (a) {
        this.notify("cell:mouseout", a)
    }
}), joint.dia.Element = joint.dia.Cell.extend({
    defaults: {
        position: {x: 0, y: 0},
        size: {width: 1, height: 1},
        angle: 0
    }, position: function (a, b, c) {
        var d = _.isNumber(b);
        if (c = (d ? c : a) || {}, c.parentRelative) {
            if (!this.collection)throw new Error("Element must be part of a collection.");
            var e = this.collection.get(this.get("parent")), f = e && !e.isLink() ? e.get("position") : {x: 0, y: 0}
        }
        if (d)return c.parentRelative && (a += f.x, b += f.y), this.set("position", {x: a, y: b}, c);
        var h = g.point(this.get("position"));
        return c.parentRelative ? h.difference(f) : h
    }, translate: function (a, b, c) {
        if (b = b || 0, 0 === a && 0 === b)return this;
        c = c || {}, c.translateBy = c.translateBy || this.id, c.tx = a, c.ty = b;
        var d = this.get("position") || {x: 0, y: 0}, e = {x: d.x + a || 0, y: d.y + b || 0};
        return c.transition ? (_.isObject(c.transition) || (c.transition = {}), this.transition("position", e, _.extend({}, c.transition, {valueFunction: joint.util.interpolate.object}))) : (this.set("position", e, c), _.invoke(this.getEmbeddedCells(), "translate", a, b, c)), this
    }, resize: function (a, b, c) {
        return this.trigger("batch:start", {batchName: "resize"}), this.set("size", {
            width: a,
            height: b
        }, c), this.trigger("batch:stop", {batchName: "resize"}), this
    }, fitEmbeds: function (a) {
        a = a || 0;
        var b = this.collection;
        if (!b)throw new Error("Element must be part of a collection.");
        var c = this.getEmbeddedCells();
        if (c.length > 0) {
            this.trigger("batch:start", {batchName: "fit-embeds"}), a.deep && _.invoke(c, "fitEmbeds", a);
            var d = b.getBBox(c), e = a.padding || 0;
            e = _.isNumber(e) ? {left: e, right: e, top: e, bottom: e} : {
                left: e.left || 0,
                right: e.right || 0,
                top: e.top || 0,
                bottom: e.bottom || 0
            }, d.moveAndExpand({
                x: -e.left,
                y: -e.top,
                width: e.right + e.left,
                height: e.bottom + e.top
            }), this.set({
                position: {x: d.x, y: d.y},
                size: {width: d.width, height: d.height}
            }, a), this.trigger("batch:stop", {batchName: "fit-embeds"})
        }
        return this
    }, rotate: function (a, b, c) {
        if (c) {
            var d = this.getBBox().center(), e = this.get("size"), f = this.get("position");
            d.rotate(c, this.get("angle") - a);
            var g = d.x - e.width / 2 - f.x, h = d.y - e.height / 2 - f.y;
            this.trigger("batch:start", {batchName: "rotate"}), this.translate(g, h), this.rotate(a, b), this.trigger("batch:stop", {batchName: "rotate"})
        } else this.set("angle", b ? a : (this.get("angle") + a) % 360);
        return this
    }, getBBox: function () {
        var a = this.get("position"), b = this.get("size");
        return g.rect(a.x, a.y, b.width, b.height)
    }
}), joint.dia.ElementView = joint.dia.CellView.extend({
    className: function () {
        return "element " + this.model.get("type").split(".").join(" ")
    }, initialize: function () {
        _.bindAll(this, "translate", "resize", "rotate"), joint.dia.CellView.prototype.initialize.apply(this, arguments), this.listenTo(this.model, "change:position", this.translate), this.listenTo(this.model, "change:size", this.resize), this.listenTo(this.model, "change:angle", this.rotate)
    }, update: function (a, b) {
        var c = this.model.get("attrs"), d = V(this.$(".rotatable")[0]);
        if (d) {
            var e = d.attr("transform");
            d.attr("transform", "")
        }
        var f = [];
        _.each(b || c, function (a, b) {
            var c = this.findBySelector(b);
            if (0 !== c.length) {
                var d = ["style", "text", "html", "ref-x", "ref-y", "ref-dx", "ref-dy", "ref-width", "ref-height", "ref", "x-alignment", "y-alignment", "port"];
                _.isObject(a.filter) && (d.push("filter"), this.applyFilter(b, a.filter)), _.isObject(a.fill) && (d.push("fill"), this.applyGradient(b, "fill", a.fill)), _.isObject(a.stroke) && (d.push("stroke"), this.applyGradient(b, "stroke", a.stroke)), _.isUndefined(a.text) || (c.each(function () {
                    V(this).text(a.text + "", {lineHeight: a.lineHeight, textPath: a.textPath})
                }), d.push("lineHeight", "textPath"));
                var e = _.omit(a, d);
                c.each(function () {
                    V(this).attr(e)
                }), a.port && c.attr("port", _.isUndefined(a.port.id) ? a.port : a.port.id), a.style && c.css(a.style), _.isUndefined(a.html) || c.each(function () {
                    $(this).html(a.html + "")
                }), _.isUndefined(a["ref-x"]) && _.isUndefined(a["ref-y"]) && _.isUndefined(a["ref-dx"]) && _.isUndefined(a["ref-dy"]) && _.isUndefined(a["x-alignment"]) && _.isUndefined(a["y-alignment"]) && _.isUndefined(a["ref-width"]) && _.isUndefined(a["ref-height"]) || _.each(c, function (a, b, c) {
                    var d = $(a);
                    d.selector = c.selector, f.push(d)
                })
            }
        }, this);
        var g = this.el.getBBox();
        b = b || {}, _.each(f, function (a) {
            var d = b[a.selector], e = d ? _.merge({}, c[a.selector], d) : c[a.selector];
            this.positionRelative(a, g, e)
        }, this), d && d.attr("transform", e || "")
    }, positionRelative: function (a, b, c) {
        function d(a) {
            return _.isNumber(a) && !_.isNaN(a)
        }

        var e = c.ref, f = parseFloat(c["ref-x"]), g = parseFloat(c["ref-y"]), h = parseFloat(c["ref-dx"]), i = parseFloat(c["ref-dy"]), j = c["y-alignment"], k = c["x-alignment"], l = parseFloat(c["ref-width"]), m = parseFloat(c["ref-height"]), n = _.contains(_.pluck(_.pluck(a.parents("g"), "className"), "baseVal"), "scalable");
        e && (b = V(this.findBySelector(e)[0]).bbox(!1, this.el));
        var o = V(a[0]);
        o.attr("transform") && o.attr("transform", o.attr("transform").replace(/translate\([^)]*\)/g, "").trim() || "");
        var p = 0, q = 0;
        if (d(l) && (l >= 0 && 1 >= l ? o.attr("width", l * b.width) : o.attr("width", Math.max(l + b.width, 0))), d(m) && (m >= 0 && 1 >= m ? o.attr("height", m * b.height) : o.attr("height", Math.max(m + b.height, 0))), d(h))if (n) {
            var r = V(this.$(".scalable")[0]).scale();
            p = b.x + b.width + h / r.sx
        } else p = b.x + b.width + h;
        if (d(i))if (n) {
            var r = V(this.$(".scalable")[0]).scale();
            q = b.y + b.height + i / r.sy
        } else q = b.y + b.height + i;
        if (d(f))if (f > 0 && 1 > f)p = b.x + b.width * f; else if (n) {
            var r = V(this.$(".scalable")[0]).scale();
            p = b.x + f / r.sx
        } else p = b.x + f;
        if (d(g))if (g > 0 && 1 > g)q = b.y + b.height * g; else if (n) {
            var r = V(this.$(".scalable")[0]).scale();
            q = b.y + g / r.sy
        } else q = b.y + g;
        var s = o.bbox(!1, this.paper.viewport);
        "middle" === j ? q -= s.height / 2 : d(j) && (q += j > -1 && 1 > j ? s.height * j : j), "middle" === k ? p -= s.width / 2 : d(k) && (p += k > -1 && 1 > k ? s.width * k : k), o.translate(p, q)
    }, renderMarkup: function () {
        var a = this.model.markup || this.model.get("markup");

        if (!a)throw new Error("properties.markup is missing while the default render() implementation is used.");
        var b = V(a);
        V(this.el).append(b)
    }, render: function () {
        return this.$el.empty(), this.renderMarkup(), this.update(), this.resize(), this.rotate(), this.translate(), this
    }, scale: function (a, b) {
        V(this.el).scale(a, b)
    }, resize: function () {
        var a = this.model.get("size") || {
                width: 1,
                height: 1
            }, b = this.model.get("angle") || 0, c = V(this.$(".scalable")[0]);
        if (c) {
            var d = c.bbox(!0);
            c.attr("transform", "scale(" + a.width / (d.width || 1) + "," + a.height / (d.height || 1) + ")");
            var e = V(this.$(".rotatable")[0]), f = e && e.attr("transform");
            if (f && "null" !== f) {
                e.attr("transform", f + " rotate(" + -b + "," + a.width / 2 + "," + a.height / 2 + ")");
                var g = c.bbox(!1, this.paper.viewport);
                this.model.set("position", {x: g.x, y: g.y}), this.rotate()
            }
            this.update()
        }
    }, translate: function (a, b, c) {
        var d = this.model.get("position") || {x: 0, y: 0};
        V(this.el).attr("transform", "translate(" + d.x + "," + d.y + ")")
    }, rotate: function () {
        var a = V(this.$(".rotatable")[0]);
        if (a) {
            var b = this.model.get("angle") || 0, c = this.model.get("size") || {
                    width: 1,
                    height: 1
                }, d = c.width / 2, e = c.height / 2;
            a.attr("transform", "rotate(" + b + "," + d + "," + e + ")")
        }
    }, getBBox: function (a) {
        if (a && a.useModelGeometry) {
            var b = this.model.getBBox().bbox(this.model.get("angle")), c = this.paper.viewport.getCTM();
            return V.transformRect(b, c)
        }
        return joint.dia.CellView.prototype.getBBox.apply(this, arguments)
    }, findParentsByKey: function (a) {
        var b = this.model.getBBox();
        return "bbox" == a ? this.paper.model.findModelsInArea(b) : this.paper.model.findModelsFromPoint(b[a]())
    }, prepareEmbedding: function () {
        this.model.toFront({
            deep: !0,
            ui: !0
        }), _.invoke(this.paper.model.getConnectedLinks(this.model, {deep: !0}), "toFront", {ui: !0});
        var a = this.model.get("parent");
        a && this.paper.model.getCell(a).unembed(this.model, {ui: !0})
    }, processEmbedding: function (a) {
        a = a || this.paper.options;
        var b = this.findParentsByKey(a.findParentBy);
        b = _.reject(b, function (a) {
            return this.model.id == a.id || a.isEmbeddedIn(this.model)
        }, this), a.frontParentOnly && (b = b.slice(-1));
        for (var c = null, d = this._candidateEmbedView, e = b.length - 1; e >= 0; e--) {
            var f = b[e];
            if (d && d.model.id == f.id) {
                c = d;
                break
            }
            var g = f.findView(this.paper);
            if (a.validateEmbedding.call(this.paper, this, g)) {
                c = g;
                break
            }
        }
        c && c != d && (d && d.unhighlight(null, {embedding: !0}), this._candidateEmbedView = c.highlight(null, {embedding: !0})), !c && d && (d.unhighlight(null, {embedding: !0}), delete this._candidateEmbedView)
    }, finalizeEmbedding: function () {
        var a = this._candidateEmbedView;
        a && (a.model.embed(this.model, {ui: !0}), a.unhighlight(null, {embedding: !0}), delete this._candidateEmbedView), _.invoke(this.paper.model.getConnectedLinks(this.model, {deep: !0}), "reparent", {ui: !0})
    }, pointerdown: function (a, b, c) {
        if (a.target.getAttribute("magnet") && this.paper.options.validateMagnet.call(this.paper, this, a.target)) {
            this.model.trigger("batch:start", {batchName: "add-link"});
            var d = this.paper.getDefaultLink(this, a.target);
            d.set({
                source: {id: this.model.id, selector: this.getSelector(a.target), port: $(a.target).attr("port")},
                target: {x: b, y: c}
            }), this.paper.model.addCell(d), this._linkView = this.paper.findViewByModel(d), this._linkView.pointerdown(a, b, c), this._linkView.startArrowheadMove("target")
        } else this._dx = b, this._dy = c, joint.dia.CellView.prototype.pointerdown.apply(this, arguments), this.notify("element:pointerdown", a, b, c)
    }, pointermove: function (a, b, c) {
        if (this._linkView)this._linkView.pointermove(a, b, c); else {
            var d = this.paper.options.gridSize, e = _.isFunction(this.options.interactive) ? this.options.interactive(this, "pointermove") : this.options.interactive;
            if (e !== !1) {
                var f = this.model.get("position");
                this.model.translate(g.snapToGrid(f.x, d) - f.x + g.snapToGrid(b - this._dx, d), g.snapToGrid(f.y, d) - f.y + g.snapToGrid(c - this._dy, d)), this.paper.options.embeddingMode && (this._inProcessOfEmbedding || (this.prepareEmbedding(), this._inProcessOfEmbedding = !0), this.processEmbedding())
            }
            this._dx = g.snapToGrid(b, d), this._dy = g.snapToGrid(c, d), joint.dia.CellView.prototype.pointermove.apply(this, arguments), this.notify("element:pointermove", a, b, c)
        }
    }, pointerup: function (a, b, c) {
        this._linkView ? (this._linkView.pointerup(a, b, c), delete this._linkView, this.model.trigger("batch:stop", {batchName: "add-link"})) : (this._inProcessOfEmbedding && (this.finalizeEmbedding(), this._inProcessOfEmbedding = !1), this.notify("element:pointerup", a, b, c), joint.dia.CellView.prototype.pointerup.apply(this, arguments))
    }
}), joint.dia.Link = joint.dia.Cell.extend({
    markup: ['<path class="connection" stroke="black"/>', '<path class="marker-source" fill="black" stroke="black" />', '<path class="marker-target" fill="black" stroke="black" />', '<path class="connection-wrap"/>', '<g class="labels"/>', '<g class="marker-vertices"/>', '<g class="marker-arrowheads"/>', '<g class="link-tools"/>'].join(""),
    labelMarkup: ['<g class="label">', "<rect />", "<text />", "</g>"].join(""),
    toolMarkup: ['<g class="link-tool">', '<g class="tool-remove" event="remove">', '<circle r="11" />', '<path transform="scale(.8) translate(-16, -16)" d="M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z"/>', "<title>Remove link.</title>", "</g>", '<g class="tool-options" event="link:options">', '<circle r="11" transform="translate(25)"/>', '<path fill="white" transform="scale(.55) translate(29, -16)" d="M31.229,17.736c0.064-0.571,0.104-1.148,0.104-1.736s-0.04-1.166-0.104-1.737l-4.377-1.557c-0.218-0.716-0.504-1.401-0.851-2.05l1.993-4.192c-0.725-0.91-1.549-1.734-2.458-2.459l-4.193,1.994c-0.647-0.347-1.334-0.632-2.049-0.849l-1.558-4.378C17.165,0.708,16.588,0.667,16,0.667s-1.166,0.041-1.737,0.105L12.707,5.15c-0.716,0.217-1.401,0.502-2.05,0.849L6.464,4.005C5.554,4.73,4.73,5.554,4.005,6.464l1.994,4.192c-0.347,0.648-0.632,1.334-0.849,2.05l-4.378,1.557C0.708,14.834,0.667,15.412,0.667,16s0.041,1.165,0.105,1.736l4.378,1.558c0.217,0.715,0.502,1.401,0.849,2.049l-1.994,4.193c0.725,0.909,1.549,1.733,2.459,2.458l4.192-1.993c0.648,0.347,1.334,0.633,2.05,0.851l1.557,4.377c0.571,0.064,1.148,0.104,1.737,0.104c0.588,0,1.165-0.04,1.736-0.104l1.558-4.377c0.715-0.218,1.399-0.504,2.049-0.851l4.193,1.993c0.909-0.725,1.733-1.549,2.458-2.458l-1.993-4.193c0.347-0.647,0.633-1.334,0.851-2.049L31.229,17.736zM16,20.871c-2.69,0-4.872-2.182-4.872-4.871c0-2.69,2.182-4.872,4.872-4.872c2.689,0,4.871,2.182,4.871,4.872C20.871,18.689,18.689,20.871,16,20.871z"/>', "<title>Link options.</title>", "</g>", "</g>"].join(""),
    vertexMarkup: ['<g class="marker-vertex-group" transform="translate(<%= x %>, <%= y %>)">', '<circle class="marker-vertex" idx="<%= idx %>" r="10" />', '<path class="marker-vertex-remove-area" idx="<%= idx %>" d="M16,5.333c-7.732,0-14,4.701-14,10.5c0,1.982,0.741,3.833,2.016,5.414L2,25.667l5.613-1.441c2.339,1.317,5.237,2.107,8.387,2.107c7.732,0,14-4.701,14-10.5C30,10.034,23.732,5.333,16,5.333z" transform="translate(5, -33)"/>', '<path class="marker-vertex-remove" idx="<%= idx %>" transform="scale(.8) translate(9.5, -37)" d="M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z">', "<title>Remove vertex.</title>", "</path>", "</g>"].join(""),
    arrowheadMarkup: ['<g class="marker-arrowhead-group marker-arrowhead-group-<%= end %>">', '<path class="marker-arrowhead" end="<%= end %>" d="M 26 0 L 0 13 L 26 26 z" />', "</g>"].join(""),
    defaults: {type: "link", source: {}, target: {}},
    disconnect: function () {
        return this.set({source: g.point(0, 0), target: g.point(0, 0)})
    },
    label: function (a, b) {
        a = a || 0;
        var c = this.get("labels") || [];
        if (0 === arguments.length || 1 === arguments.length)return c[a];
        var d = _.merge({}, c[a], b), e = c.slice();
        return e[a] = d, this.set({labels: e})
    },
    translate: function (a, b, c) {
        var d = {}, e = this.get("source"), f = this.get("target"), g = this.get("vertices");
        return e.id || (d.source = {x: e.x + a, y: e.y + b}), f.id || (d.target = {
            x: f.x + a,
            y: f.y + b
        }), g && g.length && (d.vertices = _.map(g, function (c) {
            return {x: c.x + a, y: c.y + b}
        })), this.set(d, c)
    },
    reparent: function (a) {
        var b;
        if (this.collection) {
            var c = this.collection.get(this.get("source").id), d = this.collection.get(this.get("target").id), e = this.collection.get(this.get("parent"));
            c && d && (b = this.collection.getCommonAncestor(c, d)), !e || b && b.id == e.id || e.unembed(this, a), b && b.embed(this, a)
        }
        return b
    },
    isLink: function () {
        return !0
    },
    hasLoop: function () {
        var a = this.get("source").id, b = this.get("target").id;
        return a && b && a == b
    }
}), joint.dia.LinkView = joint.dia.CellView.extend({
    className: function () {
        return _.unique(this.model.get("type").split(".").concat("link")).join(" ")
    },
    options: {
        shortLinkLength: 100,
        doubleLinkTools: !1,
        longLinkLength: 160,
        linkToolsOffset: 40,
        doubleLinkToolsOffset: 60,
        sampleInterval: 50
    },
    initialize: function (a) {
        joint.dia.CellView.prototype.initialize.apply(this, arguments), "function" != typeof this.constructor.prototype.watchSource && (this.constructor.prototype.watchSource = this.createWatcher("source"), this.constructor.prototype.watchTarget = this.createWatcher("target")), this._labelCache = {}, this._markerCache = {}, this.startListening()
    },
    startListening: function () {
        this.listenTo(this.model, "change:markup", this.render), this.listenTo(this.model, "change:smooth change:manhattan change:router change:connector", this.update), this.listenTo(this.model, "change:toolMarkup", function () {
            this.renderTools().updateToolsPosition()
        }), this.listenTo(this.model, "change:labels change:labelMarkup", function () {
            this.renderLabels().updateLabelPositions()
        }), this.listenTo(this.model, "change:vertices change:vertexMarkup", function (a, b, c) {
            this.renderVertexMarkers(), (!c.translateBy || c.translateBy == this.model.id || this.model.hasLoop()) && this.update()
        }), this.listenTo(this.model, "change:source", function (a, b) {
            this.watchSource(a, b).update()
        }), this.listenTo(this.model, "change:target", function (a, b) {
            this.watchTarget(a, b).update()
        })
    },
    render: function () {
        this.$el.empty();
        var a = V(this.model.get("markup") || this.model.markup);
        if (_.isArray(a) || (a = [a]), this._V = {}, _.each(a, function (a) {
                var b = a.attr("class");
                b && (this._V[$.camelCase(b)] = a)
            }, this), !this._V.connection)throw new Error("link: no connection path in the markup");
        return this.renderTools(), this.renderVertexMarkers(), this.renderArrowheadMarkers(), V(this.el).append(a), this.renderLabels(), this.watchSource(this.model, this.model.get("source")).watchTarget(this.model, this.model.get("target")).update(), this
    },
    renderLabels: function () {
        if (!this._V.labels)return this;
        this._labelCache = {};
        var a = $(this._V.labels.node).empty(), b = this.model.get("labels") || [];
        if (!b.length)return this;
        var c = _.template(this.model.get("labelMarkup") || this.model.labelMarkup), d = V(c()), e = this.can("labelMove");
        return _.each(b, function (b, c) {
            var f = d.clone().node;
            V(f).attr("label-idx", c), e && V(f).attr("cursor", "move"), this._labelCache[c] = V(f);
            var g = $(f).find("text"), h = $(f).find("rect"), i = _.extend({
                "text-anchor": "middle",
                "font-size": 14
            }, joint.util.getByPath(b, "attrs/text", "/"));
            g.attr(_.omit(i, "text")), _.isUndefined(i.text) || V(g[0]).text(i.text + ""), a.append(f);
            var j = V(g[0]).bbox(!0, a[0]);
            V(g[0]).translate(0, -j.height / 2);
            var k = _.extend({fill: "white", rx: 3, ry: 3}, joint.util.getByPath(b, "attrs/rect", "/"));
            h.attr(_.extend(k, {x: j.x, y: j.y - j.height / 2, width: j.width, height: j.height}))
        }, this), this
    },
    renderTools: function () {
        if (!this._V.linkTools)return this;
        var a = $(this._V.linkTools.node).empty(), b = _.template(this.model.get("toolMarkup") || this.model.toolMarkup), c = V(b());
        if (a.append(c.node), this._toolCache = c, this.options.doubleLinkTools) {
            var d = c.clone();
            a.append(d.node), this._tool2Cache = d
        }
        return this
    },
    renderVertexMarkers: function () {
        if (!this._V.markerVertices)return this;
        var a = $(this._V.markerVertices.node).empty(), b = _.template(this.model.get("vertexMarkup") || this.model.vertexMarkup);
        return _.each(this.model.get("vertices"), function (c, d) {
            a.append(V(b(_.extend({idx: d}, c))).node)
        }), this
    },
    renderArrowheadMarkers: function () {
        if (!this._V.markerArrowheads)return this;
        var a = $(this._V.markerArrowheads.node);
        a.empty();
        var b = _.template(this.model.get("arrowheadMarkup") || this.model.arrowheadMarkup);
        return this._V.sourceArrowhead = V(b({end: "source"})), this._V.targetArrowhead = V(b({end: "target"})), a.append(this._V.sourceArrowhead.node, this._V.targetArrowhead.node), this
    },
    update: function () {
        _.each(this.model.get("attrs"), function (a, b) {
            var c = [];
            _.isObject(a.fill) && (this.applyGradient(b, "fill", a.fill), c.push("fill")), _.isObject(a.stroke) && (this.applyGradient(b, "stroke", a.stroke), c.push("stroke")), _.isObject(a.filter) && (this.applyFilter(b, a.filter), c.push("filter")), c.length > 0 && (c.unshift(a), a = _.omit.apply(_, c)), this.findBySelector(b).attr(a)
        }, this);
        var a = this.route = this.findRoute(this.model.get("vertices") || []);
        this._findConnectionPoints(a);
        var b = this.getPathData(a);
        return this._V.connection.attr("d", b), this._V.connectionWrap && this._V.connectionWrap.attr("d", b), this._translateAndAutoOrientArrows(this._V.markerSource, this._V.markerTarget), this.updateLabelPositions(), this.updateToolsPosition(), this.updateArrowheadMarkers(), delete this.options.perpendicular, this.updatePostponed = !1, this
    },
    _findConnectionPoints: function (a) {
        var b, c, d, e, f = _.first(a);
        b = this.getConnectionPoint("source", this.model.get("source"), f || this.model.get("target")).round();
        var h = _.last(a);
        c = this.getConnectionPoint("target", this.model.get("target"), h || b).round();
        var i = this._markerCache;
        this._V.markerSource && (i.sourceBBox = i.sourceBBox || this._V.markerSource.bbox(!0), d = g.point(b).move(f || c, i.sourceBBox.width * this._V.markerSource.scale().sx * -1).round()), this._V.markerTarget && (i.targetBBox = i.targetBBox || this._V.markerTarget.bbox(!0), e = g.point(c).move(h || b, i.targetBBox.width * this._V.markerTarget.scale().sx * -1).round()), i.sourcePoint = d || b, i.targetPoint = e || c, this.sourcePoint = b, this.targetPoint = c
    },
    updateLabelPositions: function () {
        if (!this._V.labels)return this;
        var a = this.model.get("labels") || [];
        if (!a.length)return this;
        var b = this._V.connection.node, c = b.getTotalLength();
        if (!_.isNaN(c)) {
            var d;
            _.each(a, function (a, e) {
                var f = a.position, h = _.isObject(f) ? f.distance : f, i = _.isObject(f) ? f.offset : {x: 0, y: 0};
                h = h > c ? c : h, h = 0 > h ? c + h : h, h = h > 1 ? h : c * h;
                var j = b.getPointAtLength(h);
                if (_.isObject(i))j = g.point(j).offset(i.x, i.y); else if (_.isNumber(i)) {
                    d || (d = this._samples || this._V.connection.sample(this.options.sampleInterval));
                    for (var k, l, m, n, o = 1 / 0, p = 0, q = d.length; q > p; p++)m = d[p], n = g.line(m, j).squaredLength(), o > n && (o = n, k = m, l = p);
                    var r = d[l - 1], s = d[l + 1], t = 0;
                    s ? t = g.point(j).theta(s) : r && (t = g.point(r).theta(j)), j = g.point(j).offset(i).rotate(j, t - 90)
                }
                this._labelCache[e].attr("transform", "translate(" + j.x + ", " + j.y + ")")
            }, this)
        }
        return this
    },
    updateToolsPosition: function () {
        if (!this._V.linkTools)return this;
        var a = "", b = this.options.linkToolsOffset, c = this.getConnectionLength();
        if (!_.isNaN(c)) {
            c < this.options.shortLinkLength && (a = "scale(.5)", b /= 2);
            var d = this.getPointAtLength(b);
            if (this._toolCache.attr("transform", "translate(" + d.x + ", " + d.y + ") " + a), this.options.doubleLinkTools && c >= this.options.longLinkLength) {
                var e = this.options.doubleLinkToolsOffset || b;
                d = this.getPointAtLength(c - e), this._tool2Cache.attr("transform", "translate(" + d.x + ", " + d.y + ") " + a), this._tool2Cache.attr("visibility", "visible")
            } else this.options.doubleLinkTools && this._tool2Cache.attr("visibility", "hidden")
        }
        return this
    },
    updateArrowheadMarkers: function () {
        if (!this._V.markerArrowheads)return this;
        if ("none" === $.css(this._V.markerArrowheads.node, "display"))return this;
        var a = this.getConnectionLength() < this.options.shortLinkLength ? .5 : 1;
        return this._V.sourceArrowhead.scale(a), this._V.targetArrowhead.scale(a), this._translateAndAutoOrientArrows(this._V.sourceArrowhead, this._V.targetArrowhead), this
    },
    createWatcher: function (a) {
        function b(b, d) {
            d = d || {};
            var e = null, f = b.previous(a) || {};
            return f.id && this.stopListening(this.paper.getModelById(f.id), "change", c), d.id && (e = this.paper.getModelById(d.id), this.listenTo(e, "change", c)), c.call(this, e, {cacheOnly: !0}), this
        }

        var c = _.partial(this.onEndModelChange, a);
        return b
    },
    onEndModelChange: function (a, b, c) {
        var d = !c.cacheOnly, e = this.model.get(a) || {};
        if (b) {
            var f = this.constructor.makeSelector(e), h = "source" == a ? "target" : "source", i = this.model.get(h) || {}, j = i.id && this.constructor.makeSelector(i);
            if (c.isLoop && f == j)this[a + "BBox"] = this[h + "BBox"], this[a + "View"] = this[h + "View"], this[a + "Magnet"] = this[h + "Magnet"]; else if (c.translateBy) {
                var k = this[a + "BBox"];
                k.x += c.tx, k.y += c.ty
            } else {
                var l = this.paper.findViewByModel(e.id), m = l.el.querySelector(f);
                this[a + "BBox"] = l.getStrokeBBox(m), this[a + "View"] = l, this[a + "Magnet"] = m
            }
            if (c.isLoop && c.translateBy && this.model.isEmbeddedIn(b) && !_.isEmpty(this.model.get("vertices")) && (d = !1), !this.updatePostponed && i.id) {
                var n = this.paper.getModelById(i.id);
                c.isLoop = e.id == i.id, (c.isLoop || c.translateBy && n.isEmbeddedIn(c.translateBy)) && (this.updatePostponed = !0, d = !1)
            }
        } else this[a + "BBox"] = g.rect(e.x || 0, e.y || 0, 1, 1), this[a + "View"] = this[a + "Magnet"] = null;
        this.lastEndChange = a, d && this.update()
    },
    _translateAndAutoOrientArrows: function (a, b) {
        a && a.translateAndAutoOrient(this.sourcePoint, _.first(this.route) || this.targetPoint, this.paper.viewport), b && b.translateAndAutoOrient(this.targetPoint, _.last(this.route) || this.sourcePoint, this.paper.viewport)
    },
    removeVertex: function (a) {
        var b = _.clone(this.model.get("vertices"));
        return b && b.length && (b.splice(a, 1), this.model.set("vertices", b, {ui: !0})), this
    },
    addVertex: function (a) {
        for (var b, c = (this.model.get("vertices") || []).slice(), d = c.slice(), e = this._V.connection.node.cloneNode(!1), f = e.getTotalLength(), g = 20, h = c.length + 1; h-- && (c.splice(h, 0, a), V(e).attr("d", this.getPathData(this.findRoute(c))), b = e.getTotalLength(), b - f > g);)c = d.slice();
        return -1 === h && (h = 0, c.splice(h, 0, a)), this.model.set("vertices", c, {ui: !0}), h
    },
    sendToken: function (a, b, c) {
        b = b || 1e3, V(this.paper.viewport).append(a), V(a).animateAlongPath({
            dur: b + "ms",
            repeatCount: 1
        }, this._V.connection.node), _.delay(function () {
            V(a).remove(), c && c()
        }, b)
    },
    findRoute: function (a) {
        var b = this.model.get("router");
        if (!b) {
            if (!this.model.get("manhattan"))return a;
            b = {name: "orthogonal"}
        }
        var c = joint.routers[b.name];
        if (!_.isFunction(c))throw"unknown router: " + b.name;
        var d = c.call(this, a || [], b.args || {}, this);
        return d
    },
    getPathData: function (a) {
        var b = this.model.get("connector");
        if (b || (b = this.model.get("smooth") ? {name: "smooth"} : {name: "normal"}), !_.isFunction(joint.connectors[b.name]))throw"unknown connector: " + b.name;
        var c = joint.connectors[b.name].call(this, this._markerCache.sourcePoint, this._markerCache.targetPoint, a || this.model.get("vertices") || {}, b.args || {}, this);
        return c
    },
    getConnectionPoint: function (a, b, c) {
        var d;
        if (_.isEmpty(b) && (b = {x: 0, y: 0}), _.isEmpty(c) && (c = {x: 0, y: 0}), b.id) {
            var e, f = "source" === a ? this.sourceBBox : this.targetBBox;
            if (c.id) {
                var h = "source" === a ? this.targetBBox : this.sourceBBox;
                e = g.rect(h).intersectionWithLineFromCenterToPoint(g.rect(f).center()), e = e || g.rect(h).center()
            } else e = g.point(c);
            if (this.paper.options.perpendicularLinks || this.options.perpendicular) {
                var i, j = g.rect(0, e.y, this.paper.options.width, 1), k = g.rect(e.x, 0, 1, this.paper.options.height);
                if (j.intersect(g.rect(f)))switch (i = g.rect(f).sideNearestToPoint(e)) {
                    case"left":
                        d = g.point(f.x, e.y);
                        break;
                    case"right":
                        d = g.point(f.x + f.width, e.y);
                        break;
                    default:
                        d = g.rect(f).center()
                } else if (k.intersect(g.rect(f)))switch (i = g.rect(f).sideNearestToPoint(e)) {
                    case"top":
                        d = g.point(e.x, f.y);
                        break;
                    case"bottom":
                        d = g.point(e.x, f.y + f.height);
                        break;
                    default:
                        d = g.rect(f).center()
                } else d = g.rect(f).intersectionWithLineFromCenterToPoint(e), d = d || g.rect(f).center()
            } else if (this.paper.options.linkConnectionPoint) {
                var l = "target" === a ? this.targetView : this.sourceView, m = "target" === a ? this.targetMagnet : this.sourceMagnet;
                d = this.paper.options.linkConnectionPoint(this, l, m, e)
            } else d = g.rect(f).intersectionWithLineFromCenterToPoint(e), d = d || g.rect(f).center()
        } else d = g.point(b);
        return d
    },
    getConnectionLength: function () {
        return this._V.connection.node.getTotalLength()
    },
    getPointAtLength: function (a) {
        return this._V.connection.node.getPointAtLength(a)
    },
    _beforeArrowheadMove: function () {
        this._z = this.model.get("z"), this.model.toFront(), this.el.style.pointerEvents = "none", this.paper.options.markAvailable && this._markAvailableMagnets()
    },
    _afterArrowheadMove: function () {
        this._z && (this.model.set("z", this._z, {ui: !0}), delete this._z), this.el.style.pointerEvents = "visiblePainted", this.paper.options.markAvailable && this._unmarkAvailableMagnets()
    },
    _createValidateConnectionArgs: function (a) {
        function b(a, b) {
            return c[f] = a, c[f + 1] = a.el === b ? void 0 : b, c
        }

        var c = [];
        c[4] = a, c[5] = this;
        var d, e = 0, f = 0;
        "source" === a ? (e = 2, d = "target") : (f = 2, d = "source");
        var g = this.model.get(d);
        return g.id && (c[e] = this.paper.findViewByModel(g.id), c[e + 1] = g.selector && c[e].el.querySelector(g.selector)), b
    },
    _markAvailableMagnets: function () {
        var a = this.paper.model.getElements(), b = this.paper.options.validateConnection;
        _.chain(a).map(this.paper.findViewByModel, this.paper).each(function (a) {
            var c = "false" !== a.el.getAttribute("magnet") && b.apply(this.paper, this._validateConnectionArgs(a, null)), d = _.filter(a.el.querySelectorAll("[magnet]"), function (c) {
                return b.apply(this.paper, this._validateConnectionArgs(a, c))
            }, this);
            c && V(a.el).addClass("available-magnet"), _.each(d, function (a) {
                V(a).addClass("available-magnet")
            }), (c || d.length) && V(a.el).addClass("available-cell")
        }, this)
    },
    _unmarkAvailableMagnets: function () {
        _.each(this.paper.el.querySelectorAll(".available-cell, .available-magnet"), function (a) {
            V(a).removeClass("available-magnet").removeClass("available-cell")
        })
    },
    startArrowheadMove: function (a) {
        this._action = "arrowhead-move", this._arrowhead = a, this._validateConnectionArgs = this._createValidateConnectionArgs(this._arrowhead), this._beforeArrowheadMove()
    },
    can: function (a) {
        var b = _.isFunction(this.options.interactive) ? this.options.interactive(this, "pointerdown") : this.options.interactive;
        return _.isObject(b) && b[a] === !1 ? !1 : !0
    },
    pointerdown: function (a, b, c) {
        if (joint.dia.CellView.prototype.pointerdown.apply(this, arguments), this.notify("link:pointerdown", a, b, c), this._dx = b, this._dy = c, null == a.target.getAttribute("magnet")) {
            var d = _.isFunction(this.options.interactive) ? this.options.interactive(this, "pointerdown") : this.options.interactive;
            if (d !== !1) {
                var e, f = a.target.getAttribute("class"), g = a.target.parentNode.getAttribute("class");
                switch ("label" === g ? (f = g, e = a.target.parentNode) : e = a.target, f) {
                    case"marker-vertex":
                        this.can("vertexMove") && (this._action = "vertex-move", this._vertexIdx = a.target.getAttribute("idx"));
                        break;
                    case"marker-vertex-remove":
                    case"marker-vertex-remove-area":
                        this.can("vertexRemove") && this.removeVertex(a.target.getAttribute("idx"));
                        break;
                    case"marker-arrowhead":
                        this.can("arrowheadMove") && this.startArrowheadMove(a.target.getAttribute("end"));
                        break;
                    case"label":
                        this.can("labelMove") && (this._action = "label-move", this._labelIdx = parseInt(V(e).attr("label-idx"), 10), this._samples = this._V.connection.sample(1), this._linkLength = this._V.connection.node.getTotalLength());
                        break;
                    default:
                        var h = a.target.parentNode.getAttribute("event");
                        h ? "remove" === h ? this.model.remove() : this.paper.trigger(h, a, this, b, c) : this.can("vertexAdd") && (this._vertexIdx = this.addVertex({
                            x: b,
                            y: c
                        }), this._action = "vertex-move")
                }
            }
        }
    },
    pointermove: function (a, b, c) {
        switch (this._action) {
            case"vertex-move":
                var d = _.clone(this.model.get("vertices"));
                d[this._vertexIdx] = {x: b, y: c}, this.model.set("vertices", d, {ui: !0});
                break;
            case"label-move":
                for (var e, f, h, i, j = {
                    x: b,
                    y: c
                }, k = (this.model.get("labels")[this._labelIdx], this._samples), l = 1 / 0, m = 0, n = k.length; n > m; m++)h = k[m], i = g.line(h, j).squaredLength(), l > i && (l = i, e = h, f = m);
                var o = k[f - 1], p = k[f + 1], q = (g.point(e).distance(j), 0);
                o && p ? q = g.line(o, p).pointOffset(j) : o ? q = g.line(o, e).pointOffset(j) : p && (q = g.line(e, p).pointOffset(j)), this.model.label(this._labelIdx, {
                    position: {
                        distance: e.distance / this._linkLength,
                        offset: q
                    }
                });
                break;
            case"arrowhead-move":
                if (this.paper.options.snapLinks) {
                    var r = this.paper.options.snapLinks.radius || 50, s = this.paper.findViewsInArea({
                        x: b - r,
                        y: c - r,
                        width: 2 * r,
                        height: 2 * r
                    });
                    this._closestView && this._closestView.unhighlight(this._closestEnd.selector, {
                        connecting: !0,
                        snapping: !0
                    }), this._closestView = this._closestEnd = null;
                    var t, u = Number.MAX_VALUE, v = g.point(b, c);
                    _.each(s, function (a) {
                        "false" !== a.el.getAttribute("magnet") && (t = a.model.getBBox().center().distance(v), r > t && u > t && this.paper.options.validateConnection.apply(this.paper, this._validateConnectionArgs(a, null)) && (u = t, this._closestView = a, this._closestEnd = {id: a.model.id})), a.$("[magnet]").each(_.bind(function (b, c) {
                            var d = V(c).bbox(!1, this.paper.viewport);
                            t = v.distance({
                                x: d.x + d.width / 2,
                                y: d.y + d.height / 2
                            }), r > t && u > t && this.paper.options.validateConnection.apply(this.paper, this._validateConnectionArgs(a, c)) && (u = t, this._closestView = a, this._closestEnd = {
                                id: a.model.id,
                                selector: a.getSelector(c),
                                port: c.getAttribute("port")
                            })
                        }, this))
                    }, this), this._closestView && this._closestView.highlight(this._closestEnd.selector, {
                        connecting: !0,
                        snapping: !0
                    }), this.model.set(this._arrowhead, this._closestEnd || {x: b, y: c}, {ui: !0})
                } else {
                    var w = "mousemove" === a.type ? a.target : document.elementFromPoint(a.clientX, a.clientY);
                    this._targetEvent !== w && (this._magnetUnderPointer && this._viewUnderPointer.unhighlight(this._magnetUnderPointer, {connecting: !0}), this._viewUnderPointer = this.paper.findView(w), this._viewUnderPointer ? (this._magnetUnderPointer = this._viewUnderPointer.findMagnet(w), this._magnetUnderPointer && this.paper.options.validateConnection.apply(this.paper, this._validateConnectionArgs(this._viewUnderPointer, this._magnetUnderPointer)) ? this._magnetUnderPointer && this._viewUnderPointer.highlight(this._magnetUnderPointer, {connecting: !0}) : this._magnetUnderPointer = null) : this._magnetUnderPointer = null), this._targetEvent = w, this.model.set(this._arrowhead, {
                        x: b,
                        y: c
                    }, {ui: !0})
                }
        }
        this._dx = b, this._dy = c, joint.dia.CellView.prototype.pointermove.apply(this, arguments), this.notify("link:pointermove", a, b, c)
    },
    pointerup: function (a, b, c) {
        "label-move" === this._action ? this._samples = null : "arrowhead-move" === this._action && (this.paper.options.snapLinks ? (this._closestView && this._closestView.unhighlight(this._closestEnd.selector, {
            connecting: !0,
            snapping: !0
        }), this._closestView = this._closestEnd = null) : (this._magnetUnderPointer && (this._viewUnderPointer.unhighlight(this._magnetUnderPointer, {connecting: !0}), this.model.set(this._arrowhead, {
            id: this._viewUnderPointer.model.id,
            selector: this._viewUnderPointer.getSelector(this._magnetUnderPointer),
            port: $(this._magnetUnderPointer).attr("port")
        }, {ui: !0})), delete this._viewUnderPointer, delete this._magnetUnderPointer), this.paper.options.embeddingMode && this.model.reparent() && delete this._z, this._afterArrowheadMove()), delete this._action, this.notify("link:pointerup", a, b, c), joint.dia.CellView.prototype.pointerup.apply(this, arguments)
    }
}, {
    makeSelector: function (a) {
        var b = '[model-id="' + a.id + '"]';
        return a.port ? b += ' [port="' + a.port + '"]' : a.selector && (b += " " + a.selector), b
    }
}), joint.dia.Paper = Backbone.View.extend({
    className: "paper",
    options: {
        width: 800,
        height: 600,
        origin: {x: 0, y: 0},
        gridSize: 50,
        perpendicularLinks: !1,
        elementView: joint.dia.ElementView,
        linkView: joint.dia.LinkView,
        snapLinks: !1,
        markAvailable: !1,
        defaultLink: new joint.dia.Link,
        validateMagnet: function (a, b) {
            return "passive" !== b.getAttribute("magnet")
        },
        validateConnection: function (a, b, c, d, e, f) {
            return ("target" === e ? c : a)instanceof joint.dia.ElementView
        },
        embeddingMode: !1,
        validateEmbedding: function (a, b) {
            return !0
        },
        findParentBy: "bbox",
        frontParentOnly: !0,
        interactive: {labelMove: !1}
    },
    events: {
        mousedown: "pointerdown",
        dblclick: "mousedblclick",
        click: "mouseclick",
        touchstart: "pointerdown",
        mousemove: "pointermove",
        touchmove: "pointermove",
        "mouseover .element": "cellMouseover",
        "mouseover .link": "cellMouseover",
        "mouseout .element": "cellMouseout",
        "mouseout .link": "cellMouseout"
    },
    constructor: function (a) {
        this._configure(a), Backbone.View.apply(this, arguments)
    },
    _configure: function (a) {
        this.options && (a = _.extend({}, _.result(this, "options"), a)), this.options = a
    },
    initialize: function () {
        _.bindAll(this, "addCell", "sortCells", "resetCells", "pointerup", "asyncRenderCells"), this.svg = V("svg").node, this.viewport = V("g").addClass("viewport").node, this.defs = V("defs").node, V(this.svg).append([this.viewport, this.defs]), this.$el.append(this.svg), this.setOrigin(), this.setDimensions(), this.listenTo(this.model, "add", this.onAddCell), this.listenTo(this.model, "reset", this.resetCells), this.listenTo(this.model, "sort", this.sortCells), $(document).on("mouseup touchend", this.pointerup), this._mousemoved = !1, this.on({
            "cell:highlight": this.onCellHighlight,
            "cell:unhighlight": this.onCellUnhighlight
        })
    },
    remove: function () {
        this.removeCells(), $(document).off("mouseup touchend", this.pointerup), Backbone.View.prototype.remove.call(this)
    },
    setDimensions: function (a, b) {
        a = this.options.width = a || this.options.width, b = this.options.height = b || this.options.height, V(this.svg).attr({
            width: a,
            height: b
        }), this.trigger("resize", a, b)
    },
    setOrigin: function (a, b) {
        this.options.origin.x = a || 0, this.options.origin.y = b || 0, V(this.viewport).translate(a, b, {absolute: !0}), this.trigger("translate", a, b)
    },
    fitToContent: function (a, b, c, d) {
        _.isObject(a) ? (d = a, a = d.gridWidth || 1, b = d.gridHeight || 1, c = d.padding || 0) : (d = d || {}, a = a || 1, b = b || 1, c = c || 0), c = _.isNumber(c) ? {
            left: c,
            right: c,
            top: c,
            bottom: c
        } : {left: c.left || 0, right: c.right || 0, top: c.top || 0, bottom: c.bottom || 0};
        var e = V(this.viewport).bbox(!0, this.svg), f = V(this.viewport).scale();
        e.x *= f.sx, e.y *= f.sy, e.width *= f.sx, e.height *= f.sy;
        var g = Math.max(Math.ceil((e.width + e.x) / a), 1) * a, h = Math.max(Math.ceil((e.height + e.y) / b), 1) * b, i = 0, j = 0;
        ("negative" == d.allowNewOrigin && e.x < 0 || "positive" == d.allowNewOrigin && e.x >= 0 || "any" == d.allowNewOrigin) && (i = Math.ceil(-e.x / a) * a, i += c.left, g += i), ("negative" == d.allowNewOrigin && e.y < 0 || "positive" == d.allowNewOrigin && e.y >= 0 || "any" == d.allowNewOrigin) && (j = Math.ceil(-e.y / b) * b, j += c.top, h += j), g += c.right, h += c.bottom, g = Math.max(g, d.minWidth || 0), h = Math.max(h, d.minHeight || 0);
        var k = g != this.options.width || h != this.options.height, l = i != this.options.origin.x || j != this.options.origin.y;
        l && this.setOrigin(i, j), k && this.setDimensions(g, h)
    },
    scaleContentToFit: function (a) {
        var b = this.getContentBBox();
        if (b.width && b.height) {
            a = a || {}, _.defaults(a, {
                padding: 0,
                preserveAspectRatio: !0,
                scaleGrid: null,
                minScale: 0,
                maxScale: Number.MAX_VALUE
            });
            var c = a.padding, d = a.minScaleX || a.minScale, e = a.maxScaleX || a.maxScale, f = a.minScaleY || a.minScale, h = a.maxScaleY || a.maxScale, i = a.fittingBBox || {
                    x: this.options.origin.x,
                    y: this.options.origin.y,
                    width: this.options.width,
                    height: this.options.height
                };
            i = g.rect(i).moveAndExpand({x: c, y: c, width: -2 * c, height: -2 * c});
            var j = V(this.viewport).scale(), k = i.width / b.width * j.sx, l = i.height / b.height * j.sy;
            if (a.preserveAspectRatio && (k = l = Math.min(k, l)), a.scaleGrid) {
                var m = a.scaleGrid;
                k = m * Math.floor(k / m), l = m * Math.floor(l / m)
            }
            k = Math.min(e, Math.max(d, k)), l = Math.min(h, Math.max(f, l)), this.scale(k, l);
            var n = this.getContentBBox(), o = i.x - n.x, p = i.y - n.y;
            this.setOrigin(o, p)
        }
    },
    getContentBBox: function () {
        var a = this.viewport.getBoundingClientRect(), b = this.viewport.getScreenCTM(), c = this.viewport.getCTM(), d = g.rect({
            x: a.left - b.e + c.e,
            y: a.top - b.f + c.f,
            width: a.width,
            height: a.height
        });
        return d
    },
    createViewForModel: function (a) {
        var b, c = a.get("type"), d = c.split(".")[0], e = c.split(".")[1];
        return b = joint.shapes[d] && joint.shapes[d][e + "View"] ? new joint.shapes[d][e + "View"]({
            model: a,
            interactive: this.options.interactive
        }) : a instanceof joint.dia.Element ? new this.options.elementView({
            model: a,
            interactive: this.options.interactive
        }) : new this.options.linkView({model: a, interactive: this.options.interactive})
    },
    onAddCell: function (a, b, c) {
        if (this.options.async && c.async !== !1 && _.isNumber(c.position)) {
            if (this._asyncCells = this._asyncCells || [], this._asyncCells.push(a), 0 == c.position) {
                if (this._frameId)throw"another asynchronous rendering in progress";
                this.asyncRenderCells(this._asyncCells), delete this._asyncCells
            }
        } else this.addCell(a)
    },
    addCell: function (a) {
        var b = this.createViewForModel(a);
        V(this.viewport).append(b.el), b.paper = this, b.render(), $(b.el).find("image").on("dragstart", function () {
            return !1
        })
    },
    beforeRenderCells: function (a) {
        return a.sort(function (a, b) {
            return a instanceof joint.dia.Link ? 1 : -1
        }), a
    },
    afterRenderCells: function () {
        this.sortCells()
    },
    resetCells: function (a, b) {
        $(this.viewport).empty();
        var c = a.models.slice();
        c = this.beforeRenderCells(c, b), this._frameId && (joint.util.cancelFrame(this._frameId), delete this._frameId), this.options.async ? this.asyncRenderCells(c, b) : (_.each(c, this.addCell, this), this.sortCells())
    },
    removeCells: function () {
        this.model.get("cells").each(function (a) {
            var b = this.findViewByModel(a);
            b && b.remove()
        }, this)
    },
    asyncBatchAdded: _.identity,
    asyncRenderCells: function (a, b) {
        var c = !1;
        this._frameId && (_.each(_.range(this.options.async && this.options.async.batchSize || 50), function () {
            var b = a.shift();

            c = !b, c || this.addCell(b)
        }, this), this.asyncBatchAdded()), c ? (delete this._frameId, this.afterRenderCells(b), this.trigger("render:done", b)) : this._frameId = joint.util.nextFrame(_.bind(function () {
            this.asyncRenderCells(a, b)
        }, this))
    },
    sortCells: function () {
        var a = $(this.viewport).children("[model-id]"), b = this.model.get("cells");
        this.sortElements(a, function (a, c) {
            var d = b.get($(a).attr("model-id")), e = b.get($(c).attr("model-id"));
            return (d.get("z") || 0) > (e.get("z") || 0) ? 1 : -1
        })
    },
    sortElements: function (a, b) {
        var c = $(a), d = c.map(function () {
            var a = this, b = a.parentNode, c = b.insertBefore(document.createTextNode(""), a.nextSibling);
            return function () {
                if (b === this)throw new Error("You can't sort elements if any one is a descendant of another.");
                b.insertBefore(this, c), b.removeChild(c)
            }
        });
        return Array.prototype.sort.call(c, b).each(function (a) {
            d[a].call(this)
        })
    },
    scale: function (a, b, c, d) {
        b = b || a, _.isUndefined(c) && (c = 0, d = 0), V(this.viewport).attr("transform", "");
        var e = this.options.origin.x, f = this.options.origin.y;
        if (c || d || e || f) {
            var g = e - c * (a - 1), h = f - d * (b - 1);
            this.setOrigin(g, h)
        }
        return V(this.viewport).scale(a, b), this.trigger("scale", a, b, c, d), this
    },
    rotate: function (a, b, c) {
        if (_.isUndefined(b)) {
            var d = this.viewport.getBBox();
            b = d.width / 2, c = d.height / 2
        }
        V(this.viewport).rotate(a, b, c)
    },
    findView: function (a) {
        var b = this.$(a);
        return 0 === b.length || b[0] === this.el ? void 0 : b.data("view") || this.findView(b.parent())
    },
    findViewByModel: function (a) {
        var b = _.isString(a) ? a : a.id, c = this.$('[model-id="' + b + '"]');
        return c.length ? c.data("view") : void 0
    },
    findViewsFromPoint: function (a) {
        a = g.point(a);
        var b = _.map(this.model.getElements(), this.findViewByModel);
        return _.filter(b, function (b) {
            return b && g.rect(V(b.el).bbox(!1, this.viewport)).containsPoint(a)
        }, this)
    },
    findViewsInArea: function (a) {
        a = g.rect(a);
        var b = _.map(this.model.getElements(), this.findViewByModel);
        return _.filter(b, function (b) {
            return b && a.intersect(g.rect(V(b.el).bbox(!1, this.viewport)))
        }, this)
    },
    getModelById: function (a) {
        return this.model.getCell(a)
    },
    snapToGrid: function (a) {
        var b = V(this.viewport).toLocalPoint(a.x, a.y);
        return {x: g.snapToGrid(b.x, this.options.gridSize), y: g.snapToGrid(b.y, this.options.gridSize)}
    },
    clientToLocalPoint: function (a) {
        var b = this.svg.createSVGPoint();
        b.x = a.x, b.y = a.y;
        var c = V("rect", {width: this.options.width, height: this.options.height, x: 0, y: 0, opacity: 0});
        V(this.svg).prepend(c);
        var d = $(this.svg).offset();
        c.remove();
        var e = document.body.scrollTop || document.documentElement.scrollTop, f = document.body.scrollLeft || document.documentElement.scrollLeft;
        b.x += f - d.left, b.y += e - d.top;
        var g = b.matrixTransform(this.viewport.getCTM().inverse());
        return g
    },
    getDefaultLink: function (a, b) {
        return _.isFunction(this.options.defaultLink) ? this.options.defaultLink.call(this, a, b) : this.options.defaultLink.clone()
    },
    onCellHighlight: function (a, b) {
        V(b).addClass("highlighted")
    },
    onCellUnhighlight: function (a, b) {
        V(b).removeClass("highlighted")
    },
    mousedblclick: function (a) {
        a.preventDefault(), a = joint.util.normalizeEvent(a);
        var b = this.findView(a.target), c = this.snapToGrid({x: a.clientX, y: a.clientY});
        b ? b.pointerdblclick(a, c.x, c.y) : this.trigger("blank:pointerdblclick", a, c.x, c.y)
    },
    mouseclick: function (a) {
        if (!this._mousemoved) {
            a = joint.util.normalizeEvent(a);
            var b = this.findView(a.target), c = this.snapToGrid({x: a.clientX, y: a.clientY});
            b ? b.pointerclick(a, c.x, c.y) : this.trigger("blank:pointerclick", a, c.x, c.y)
        }
        this._mousemoved = !1
    },
    pointerdown: function (a) {
        a = joint.util.normalizeEvent(a);
        var b = this.findView(a.target), c = this.snapToGrid({x: a.clientX, y: a.clientY});
        b ? (this.sourceView = b, b.pointerdown(a, c.x, c.y)) : this.trigger("blank:pointerdown", a, c.x, c.y)
    },
    pointermove: function (a) {
        if (a.preventDefault(), a = joint.util.normalizeEvent(a), this.sourceView) {
            this._mousemoved = !0;
            var b = this.snapToGrid({x: a.clientX, y: a.clientY});
            this.sourceView.pointermove(a, b.x, b.y)
        }
    },
    pointerup: function (a) {
        a = joint.util.normalizeEvent(a);
        var b = this.snapToGrid({x: a.clientX, y: a.clientY});
        this.sourceView ? (this.sourceView.pointerup(a, b.x, b.y), this.sourceView = null) : this.trigger("blank:pointerup", a, b.x, b.y)
    },
    cellMouseover: function (a) {
        a = joint.util.normalizeEvent(a);
        var b = this.findView(a.target);
        b && b.mouseover(a)
    },
    cellMouseout: function (a) {
        a = joint.util.normalizeEvent(a);
        var b = this.findView(a.target);
        b && b.mouseout(a)
    }
}), joint.shapes.basic = {}, joint.shapes.basic.Generic = joint.dia.Element.extend({
    defaults: joint.util.deepSupplement({
        type: "basic.Generic",
        attrs: {".": {fill: "#FFFFFF", stroke: "none"}}
    }, joint.dia.Element.prototype.defaults)
}), joint.shapes.basic.Rect = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><rect/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Rect",
        attrs: {
            rect: {fill: "#FFFFFF", stroke: "black", width: 100, height: 60},
            text: {
                "font-size": 14,
                text: "",
                "ref-x": .5,
                "ref-y": .5,
                ref: "rect",
                "y-alignment": "middle",
                "x-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.TextView = joint.dia.ElementView.extend({
    initialize: function () {
        joint.dia.ElementView.prototype.initialize.apply(this, arguments), this.listenTo(this.model, "change:attrs", this.resize)
    }
}), joint.shapes.basic.Text = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><text/></g></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Text",
        attrs: {text: {"font-size": 18, fill: "black"}}
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Circle = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><circle/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Circle",
        size: {width: 60, height: 60},
        attrs: {
            circle: {fill: "#FFFFFF", stroke: "black", r: 30, transform: "translate(30, 30)"},
            text: {
                "font-size": 14,
                text: "",
                "text-anchor": "middle",
                "ref-x": .5,
                "ref-y": .5,
                ref: "circle",
                "y-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Ellipse = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><ellipse/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Ellipse",
        size: {width: 60, height: 40},
        attrs: {
            ellipse: {fill: "#FFFFFF", stroke: "black", rx: 30, ry: 20, transform: "translate(30, 20)"},
            text: {
                "font-size": 14,
                text: "",
                "text-anchor": "middle",
                "ref-x": .5,
                "ref-y": .5,
                ref: "ellipse",
                "y-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Polygon = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><polygon/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Polygon",
        size: {width: 60, height: 40},
        attrs: {
            polygon: {fill: "#FFFFFF", stroke: "black"},
            text: {
                "font-size": 14,
                text: "",
                "text-anchor": "middle",
                "ref-x": .5,
                "ref-dy": 20,
                ref: "polygon",
                "y-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Polyline = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><polyline/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Polyline",
        size: {width: 60, height: 40},
        attrs: {
            polyline: {fill: "#FFFFFF", stroke: "black"},
            text: {
                "font-size": 14,
                text: "",
                "text-anchor": "middle",
                "ref-x": .5,
                "ref-dy": 20,
                ref: "polyline",
                "y-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Image = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><image/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Image",
        attrs: {
            text: {
                "font-size": 14,
                text: "",
                "text-anchor": "middle",
                "ref-x": .5,
                "ref-dy": 20,
                ref: "image",
                "y-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Path = joint.shapes.basic.Generic.extend({
    markup: '<g class="rotatable"><g class="scalable"><path/></g><text/></g>',
    defaults: joint.util.deepSupplement({
        type: "basic.Path",
        size: {width: 60, height: 60},
        attrs: {
            path: {fill: "#FFFFFF", stroke: "black"},
            text: {
                "font-size": 14,
                text: "",
                "text-anchor": "middle",
                "ref-x": .5,
                "ref-dy": 20,
                ref: "path",
                "y-alignment": "middle",
                fill: "black",
                "font-family": "Arial, helvetica, sans-serif"
            }
        }
    }, joint.shapes.basic.Generic.prototype.defaults)
}), joint.shapes.basic.Rhombus = joint.shapes.basic.Path.extend({
    defaults: joint.util.deepSupplement({
        type: "basic.Rhombus",
        attrs: {path: {d: "M 30 0 L 60 30 30 60 0 30 z"}, text: {"ref-y": .5}}
    }, joint.shapes.basic.Path.prototype.defaults)
}), joint.shapes.basic.PortsModelInterface = {
    initialize: function () {
        this.updatePortsAttrs(), this.on("change:inPorts change:outPorts", this.updatePortsAttrs, this), this.constructor.__super__.constructor.__super__.initialize.apply(this, arguments)
    }, updatePortsAttrs: function (a) {
        var b = this.get("attrs");
        _.each(this._portSelectors, function (a) {
            b[a] && delete b[a]
        }), this._portSelectors = [];
        var c = {};
        _.each(this.get("inPorts"), function (a, b, d) {
            var e = this.getPortAttrs(a, b, d.length, ".inPorts", "in");
            this._portSelectors = this._portSelectors.concat(_.keys(e)), _.extend(c, e)
        }, this), _.each(this.get("outPorts"), function (a, b, d) {
            var e = this.getPortAttrs(a, b, d.length, ".outPorts", "out");
            this._portSelectors = this._portSelectors.concat(_.keys(e)), _.extend(c, e)
        }, this), this.attr(c, {silent: !0}), this.processPorts(), this.trigger("process:ports")
    }, getPortSelector: function (a) {
        var b = ".inPorts", c = this.get("inPorts").indexOf(a);
        if (0 > c && (b = ".outPorts", c = this.get("outPorts").indexOf(a), 0 > c))throw new Error("getPortSelector(): Port doesn't exist.");
        return b + ">g:nth-child(" + (c + 1) + ")>circle"
    }
}, joint.shapes.basic.PortsViewInterface = {
    initialize: function () {
        this.listenTo(this.model, "process:ports", this.update), joint.dia.ElementView.prototype.initialize.apply(this, arguments)
    }, update: function () {
        this.renderPorts(), joint.dia.ElementView.prototype.update.apply(this, arguments)
    }, renderPorts: function () {
        var a = this.$(".inPorts").empty(), b = this.$(".outPorts").empty(), c = _.template(this.model.portMarkup);
        _.each(_.filter(this.model.ports, function (a) {
            return "in" === a.type
        }), function (b, d) {
            a.append(V(c({id: d, port: b})).node)
        }), _.each(_.filter(this.model.ports, function (a) {
            return "out" === a.type
        }), function (a, d) {
            b.append(V(c({id: d, port: a})).node)
        })
    }
}, joint.shapes.basic.TextBlock = joint.shapes.basic.Generic.extend({
    markup: ['<g class="rotatable"><g class="scalable"><rect/></g><switch>', '<foreignObject requiredFeatures="http://www.w3.org/TR/SVG11/feature#Extensibility" class="fobj">', '<body xmlns="http://www.w3.org/1999/xhtml"><div/></body>', "</foreignObject>", '<text class="content"/>', "</switch></g>"].join(""),
    defaults: joint.util.deepSupplement({
        type: "basic.TextBlock",
        attrs: {
            rect: {fill: "#ffffff", stroke: "#000000", width: 80, height: 100},
            text: {fill: "#000000", "font-size": 14, "font-family": "Arial, helvetica, sans-serif"},
            ".content": {
                text: "",
                ref: "rect",
                "ref-x": .5,
                "ref-y": .5,
                "y-alignment": "middle",
                "x-alignment": "middle"
            }
        },
        content: ""
    }, joint.shapes.basic.Generic.prototype.defaults),
    initialize: function () {
        "undefined" != typeof SVGForeignObjectElement && (this.setForeignObjectSize(this, this.get("size")), this.setDivContent(this, this.get("content")), this.listenTo(this, "change:size", this.setForeignObjectSize), this.listenTo(this, "change:content", this.setDivContent)), joint.shapes.basic.Generic.prototype.initialize.apply(this, arguments)
    },
    setForeignObjectSize: function (a, b) {
        a.attr({".fobj": _.clone(b), div: {style: _.clone(b)}})
    },
    setDivContent: function (a, b) {
        a.attr({div: {html: b}})
    }
}), joint.shapes.basic.TextBlockView = joint.dia.ElementView.extend({
    initialize: function () {
        joint.dia.ElementView.prototype.initialize.apply(this, arguments), "undefined" == typeof SVGForeignObjectElement && (this.noSVGForeignObjectElement = !0, this.listenTo(this.model, "change:content", function (a) {
            this.updateContent(a)
        }))
    }, update: function (a, b) {
        if (this.noSVGForeignObjectElement) {
            var c = this.model, d = _.omit(b || c.get("attrs"), ".content");
            joint.dia.ElementView.prototype.update.call(this, c, d), (!b || _.has(b, ".content")) && this.updateContent(c, b)
        } else joint.dia.ElementView.prototype.update.call(this, c, b)
    }, updateContent: function (a, b) {
        var c = _.merge({}, (b || a.get("attrs"))[".content"]);
        delete c.text;
        var d = joint.util.breakText(a.get("content"), a.get("size"), c, {svgDocument: this.paper.svg}), e = joint.util.setByPath({}, ".content", c, "/");
        e[".content"].text = d, joint.dia.ElementView.prototype.update.call(this, a, e)
    }
}), joint.routers.orthogonal = function () {
    function a(a, b) {
        return a.x == b.x ? a.y > b.y ? "N" : "S" : a.y == b.y ? a.x > b.x ? "W" : "E" : null
    }

    function b(a, b) {
        return a["W" == b || "E" == b ? "width" : "height"]
    }

    function c(a, b) {
        return g.rect(a).moveAndExpand({x: -b, y: -b, width: 2 * b, height: 2 * b})
    }

    function d(a) {
        return g.rect(a.x, a.y, 0, 0)
    }

    function e(a, b) {
        var c = Math.min(a.x, b.x), d = Math.min(a.y, b.y), e = Math.max(a.x + a.width, b.x + b.width), f = Math.max(a.y + a.height, b.y + b.height);
        return g.rect(c, d, e - c, f - d)
    }

    function f(a, b, c) {
        var d = g.point(a.x, b.y);
        return c.containsPoint(d) && (d = g.point(b.x, a.y)), d
    }

    function h(b, c, d) {
        var e = g.point(b.x, c.y), f = g.point(c.x, b.y), h = a(b, e), i = a(b, f), j = n[d], k = h == d || h != j && (i == j || i != d) ? e : f;
        return {points: [k], direction: a(k, c)}
    }

    function i(b, c, d) {
        var e = f(b, c, d);
        return {points: [e], direction: a(e, c)}
    }

    function j(c, d, e, h) {
        var i, j = {}, k = [g.point(c.x, d.y), g.point(d.x, c.y)], l = _.filter(k, function (a) {
            return !e.containsPoint(a)
        }), m = _.filter(l, function (b) {
            return a(b, c) != h
        });
        if (m.length > 0)i = _.filter(m, function (b) {
            return a(c, b) == h
        }).pop(), i = i || m[0], j.points = [i], j.direction = a(i, d); else {
            i = _.difference(k, l)[0];
            var n = g.point(d).move(i, -b(e, h) / 2), o = f(n, c, e);
            j.points = [o, n], j.direction = a(n, d)
        }
        return j
    }

    function k(c, d, e, f) {
        var j = i(d, c, f), k = j.points[0];
        if (e.containsPoint(k)) {
            j = i(c, d, e);
            var l = j.points[0];
            if (f.containsPoint(l)) {
                var m = g.point(c).move(l, -b(e, a(c, l)) / 2), n = g.point(d).move(k, -b(f, a(d, k)) / 2), o = g.line(m, n).midpoint(), p = i(c, o, e), q = h(o, d, p.direction);
                j.points = [p.points[0], q.points[0]], j.direction = q.direction
            }
        }
        return j
    }

    function l(b, d, h, i, j) {
        var k, l, m, n = {}, p = c(e(h, i), 1), q = p.center().distance(d) > p.center().distance(b), r = q ? d : b, s = q ? b : d;
        return j ? (k = g.point.fromPolar(p.width + p.height, o[j], r), k = p.pointNearestToPoint(k).move(k, -1)) : k = p.pointNearestToPoint(r).move(r, 1), l = f(k, s, p), k.round().equals(l.round()) ? (l = g.point.fromPolar(p.width + p.height, g.toRad(k.theta(r)) + Math.PI / 2, s), l = p.pointNearestToPoint(l).move(s, 1).round(), m = f(k, l, p), n.points = q ? [l, m, k] : [k, m, l]) : n.points = q ? [l, k] : [k, l], n.direction = q ? a(k, d) : a(l, d), n
    }

    function m(b, e, f) {
        var m = e.elementPadding || 20, n = [], o = c(f.sourceBBox, m), p = c(f.targetBBox, m);
        b = _.map(b, g.point), b.unshift(o.center()), b.push(p.center());
        for (var q, r = 0, s = b.length - 1; s > r; r++) {
            var t = null, u = b[r], v = b[r + 1], w = !!a(u, v);
            if (0 == r)r + 1 == s ? o.intersect(c(p, 1)) ? t = l(u, v, o, p) : w || (t = k(u, v, o, p)) : o.containsPoint(v) ? t = l(u, v, o, c(d(v), m)) : w || (t = i(u, v, o)); else if (r + 1 == s) {
                var x = w && a(v, u) == q;
                p.containsPoint(u) || x ? t = l(u, v, c(d(u), m), p, q) : w || (t = j(u, v, p, q))
            } else w || (t = h(u, v, q));
            t ? (Array.prototype.push.apply(n, t.points), q = t.direction) : q = a(u, v), s > r + 1 && n.push(v)
        }
        return n
    }

    var n = {N: "S", S: "N", E: "W", W: "E"}, o = {N: -Math.PI / 2 * 3, S: -Math.PI / 2, E: 0, W: Math.PI};
    return m
}(), joint.routers.manhattan = function () {
    "use strict";
    function a(a, b) {
        for (var c, d = [], e = {x: 0, y: 0}, f = b; c = a[f];) {
            var g = c.difference(f);
            g.equals(e) || (d.unshift(f), e = g), f = c
        }
        return d.unshift(f), d
    }

    function b(a, b, c) {
        var d = c.step, e = a.center(), f = _.chain(c.directionMap).pick(b).map(function (b) {
            var c = b.x * a.width / 2, f = b.y * a.height / 2, h = g.point(e).offset(c, f).snapToGrid(d);
            return a.containsPoint(h) && h.offset(b.x * d, b.y * d), h
        }).value();
        return f
    }

    function c(a, b, c) {
        var d = 360 / c, e = Math.floor(a.theta(b) / d);
        return c - e
    }

    function d(d, e, f, h) {
        var i = h.reversed ? h.endDirections : h.startDirections, j = h.reversed ? h.startDirections : h.endDirections, k = d instanceof g.rect ? b(d, i, h) : [d], l = e instanceof g.rect ? b(e, j, h) : [e], m = k.length > 1 ? d.center() : k[0], n = l.length > 1 ? e.center() : l[0], o = _.filter(l, function (a) {
            var b = g.point(a).snapToGrid(h.mapGridSize).toString(), c = _.every(f[b], function (b) {
                return !b.containsPoint(a)
            });
            return c
        });
        if (o.length)for (var p = h.step, q = h.penalties, r = _.chain(o).invoke("snapToGrid", p).min(function (a) {
            return h.estimateCost(m, a)
        }).value(), s = {}, t = {}, u = {}, v = h.directions, w = v.length, x = w / 2, y = h.previousDirIndexes || {}, z = {}, A = {}, B = _.chain(k).invoke("snapToGrid", p).each(function (a) {
            var b = a.toString();
            t[b] = 0, u[b] = h.estimateCost(a, r), y[b] = y[b] || c(m, a, w), A[b] = !0
        }).map(function (a) {
            return a.toString()
        }).sortBy(function (a) {
            return u[a]
        }).value(), C = h.maximumLoops, D = h.maxAllowedDirectionChange; B.length && C--;) {
            var E = B[0], F = g.point(E);
            if (r.equals(F))return h.previousDirIndexes = _.pick(y, E), a(s, F);
            B.splice(0, 1), A[M] = null, z[M] = !0;
            for (var G = y[E], H = t[E], I = 0; w > I; I++) {
                var J = Math.abs(I - G);
                if (J > x && (J = w - J), !(J > D)) {
                    var K = v[I], L = g.point(F).offset(K.offsetX, K.offsetY), M = L.toString();
                    if (!z[M]) {
                        var N = g.point(L).snapToGrid(h.mapGridSize).toString(), O = _.every(f[N], function (a) {
                            return !a.containsPoint(L)
                        });
                        if (O) {
                            var P = _.has(A, M), Q = H + K.cost;
                            if ((!P || Q < t[M]) && (s[M] = F, y[M] = I, t[M] = Q, u[M] = Q + h.estimateCost(L, r) + q[J], !P)) {
                                var R = _.sortedIndex(B, M, function (a) {
                                    return u[a]
                                });
                                B.splice(R, 0, M), A[M] = !0
                            }
                        }
                    }
                }
            }
        }
        return h.fallbackRoute(m, n, h)
    }

    function e(a, b) {
        b.directions = _.result(b, "directions"), b.penalties = _.result(b, "penalties"), b.paddingBox = _.result(b, "paddingBox"), this.options.perpendicular = !!b.perpendicular;
        var c = b.reversed = "source" === this.lastEndChange, e = g.rect(c ? this.targetBBox : this.sourceBBox), f = g.rect(c ? this.sourceBBox : this.targetBBox);
        e.moveAndExpand(b.paddingBox), f.moveAndExpand(b.paddingBox);
        var h = this.model, i = this.paper.model, j = _.chain(b.excludeEnds).map(h.get, h).pluck("id").map(i.getCell, i).value(), k = b.mapGridSize, l = [], m = h.get("source").id;
        if (void 0 !== m) {
            var n = i.getCell(m);
            void 0 !== n && (l = _.union(l, _.map(n.getAncestors(), "id")))
        }
        var o = h.get("target").id;
        if (void 0 !== o) {
            var p = i.getCell(o);
            void 0 !== p && (l = _.union(l, _.map(p.getAncestors(), "id")))
        }
        for (var q = _.chain(i.getElements()).difference(j).reject(function (a) {
            return _.contains(b.excludeTypes, a.get("type")) || _.contains(l, a.id)
        }).invoke("getBBox").invoke("moveAndExpand", b.paddingBox).foldl(function (a, b) {
            for (var c = b.origin().snapToGrid(k), d = b.corner().snapToGrid(k), e = c.x; e <= d.x; e += k)for (var f = c.y; f <= d.y; f += k) {
                var g = e + "@" + f;
                a[g] = a[g] || [], a[g].push(b)
            }
            return a
        }, {}).value(), r = [], s = _.map(a, g.point), t = e.center(), u = 0, v = s.length; v >= u; u++) {
            var w = null, x = y || e, y = s[u];
            if (!y) {
                y = f;
                var z = !this.model.get("source").id || !this.model.get("target").id;
                if (z && _.isFunction(b.draggingRoute)) {
                    var A = x instanceof g.rect ? x.center() : x;
                    w = b.draggingRoute(A, y.origin(), b)
                }
            }
            w = w || d(x, y, q, b);
            var B = _.first(w);
            B && B.equals(t) && w.shift(), t = _.last(w) || t, r = r.concat(w)
        }
        return c ? r.reverse() : r
    }

    var f = {
        step: 10,
        perpendicular: !0,
        mapGridSize: 100,
        excludeEnds: [],
        excludeTypes: ["basic.Text"],
        maximumLoops: 500,
        startDirections: ["left", "right", "top", "bottom"],
        endDirections: ["left", "right", "top", "bottom"],
        directionMap: {right: {x: 1, y: 0}, bottom: {x: 0, y: 1}, left: {x: -1, y: 0}, top: {x: 0, y: -1}},
        maxAllowedDirectionChange: 1,
        paddingBox: function () {
            var a = this.step;
            return {x: -a, y: -a, width: 2 * a, height: 2 * a}
        },
        directions: function () {
            var a = this.step;
            return [{offsetX: a, offsetY: 0, cost: a}, {offsetX: 0, offsetY: a, cost: a}, {
                offsetX: -a,
                offsetY: 0,
                cost: a
            }, {offsetX: 0, offsetY: -a, cost: a}]
        },
        penalties: function () {
            return [0, this.step / 2, this.step]
        },
        estimateCost: function (a, b) {
            return a.manhattanDistance(b)
        },
        fallbackRoute: function (a, b, c) {
            var d = c.prevDirIndexes || {}, e = (d[a] || 0) % 2 ? g.point(a.x, b.y) : g.point(b.x, a.y);
            return [e, b]
        },
        draggingRoute: null
    };
    return function (a, b, c) {
        return e.call(c, a, _.extend({}, f, b))
    }
}(), joint.routers.metro = function () {
    if (!_.isFunction(joint.routers.manhattan))throw"Metro requires the manhattan router.";
    var a = {
        diagonalCost: null, directions: function () {
            var a = this.step, b = this.diagonalCost || Math.ceil(Math.sqrt(a * a << 1));
            return [{offsetX: a, offsetY: 0, cost: a}, {offsetX: a, offsetY: a, cost: b}, {
                offsetX: 0,
                offsetY: a,
                cost: a
            }, {offsetX: -a, offsetY: a, cost: b}, {offsetX: -a, offsetY: 0, cost: a}, {
                offsetX: -a,
                offsetY: -a,
                cost: b
            }, {offsetX: 0, offsetY: -a, cost: a}, {offsetX: a, offsetY: -a, cost: b}]
        }, fallbackRoute: function (a, b, c) {
            var d = a.theta(b), e = {x: b.x, y: a.y}, f = {x: a.x, y: b.y};
            if (d % 180 > 90) {
                var h = e;
                e = f, f = h
            }
            var i = 45 > d % 90 ? e : f, j = g.line(a, i), k = 90 * Math.ceil(d / 90), l = g.point.fromPolar(j.squaredLength(), g.toRad(k + 135), i), m = g.line(b, l), n = j.intersection(m);
            return n ? [n.round(), b] : [b]
        }
    };
    return function (b, c, d) {
        return joint.routers.manhattan(b, _.extend({}, a, c), d)
    }
}(), joint.connectors.normal = function (a, b, c) {
    var d = ["M", a.x, a.y];
    return _.each(c, function (a) {
        d.push(a.x, a.y)
    }), d.push(b.x, b.y), d.join(" ")
}, joint.connectors.rounded = function (a, b, c, d) {
    var e, f, h, i, j, k, l = d.radius || 10, m = ["M", a.x, a.y];
    return _.each(c, function (d, n) {
        j = c[n - 1] || a, k = c[n + 1] || b, h = i || g.point(d).distance(j) / 2, i = g.point(d).distance(k) / 2, e = g.point(d).move(j, -Math.min(l, h)).round(), f = g.point(d).move(k, -Math.min(l, i)).round(), m.push(e.x, e.y, "S", d.x, d.y, f.x, f.y, "L")
    }), m.push(b.x, b.y), m.join(" ")
}, joint.connectors.smooth = function (a, b, c) {
    var d;
    if (c.length)d = g.bezier.curveThroughPoints([a].concat(c).concat([b])); else {
        var e = a.x < b.x ? b.x - (b.x - a.x) / 2 : a.x - (a.x - b.x) / 2;
        d = ["M", a.x, a.y, "C", e, a.y, e, b.y, b.x, b.y]
    }
    return d.join(" ")
};