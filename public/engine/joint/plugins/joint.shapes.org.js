/*! JointJS v0.9.3 - JavaScript diagramming library  2015-05-22


 This Source Code Form is subject to the terms of the Mozilla Public
 License, v. 2.0. If a copy of the MPL was not distributed with this
 file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
joint.shapes.org = {}, joint.shapes.org.Member = joint.dia.Element.extend({
    markup: '<g class="rotatable"><g class="scalable"><rect class="card"/><image/></g><text class="rank"/><text class="name"/></g>',
    defaults: joint.util.deepSupplement({
        type: "org.Member",
        size: {width: 210, height: 60},
        attrs: {
            rect: {width: 190, height: 55},
            ".card": {
                fill: "#FFFFFF",
                stroke: "#000000",
                "stroke-width": 2,
                "pointer-events": "visiblePainted",
                rx: 10,
                ry: 10
            },
            image: {width: 48, height: 48, ref: ".card", "ref-x": 10, "ref-y": 5},
            ".rank": {
                "text-decoration": "none",
                ref: ".card",
                "ref-x": .9,
                "ref-y": .2,
                "font-family": "Arial",
                "font-size": 12,
                "text-anchor": "end"
            },
            ".name": {
                "font-weight": "800",
                ref: ".card",
                "ref-x": .9,
                "ref-y": .6,
                "font-family": "Arial",
                "font-size": 14,
                "text-anchor": "end"
            }
        }
    }, joint.dia.Element.prototype.defaults)
}), joint.shapes.org.Arrow = joint.dia.Link.extend({
    defaults: {
        type: "org.Arrow",
        source: {selector: ".card"},
        target: {selector: ".card"},
        attrs: {
            ".connection": {stroke: "#585858", "stroke-width": 3},
            ".marker-target": { fill: "#585858", d: "M 10 0 L 0 5 L 10 10 z" }},
        z: -1
    }
}), joint.shapes.org.ArrowDash = joint.dia.Link.extend({
    defaults: {
        type: "org.Arrow",
        source: {selector: ".card"},
        target: {selector: ".card"},
        attrs: {
            ".connection": {stroke: "#585858", "stroke-width": 3, 'stroke-dasharray': '5 2'},
            ".marker-target": {fill: "#585858", d: "M 10 0 L 0 5 L 10 10 z"}
        },
        z: -1
    }
});