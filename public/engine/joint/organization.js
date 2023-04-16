/**
 * Created by aidiCMS on 6/11/2015.
 */

require(['joint', 'joint.shapes.org'], function(joint) {
    var graph = new joint.dia.Graph;
    var $profilWidth = $('#profil').width();
    var paper = new joint.dia.Paper({
        el: $('#paper'),
        width: ($profilWidth-100),
        height: 1850,
        gridSize: 1,
        model: graph,
        perpendicularLinks: true
    });

    var member = function(x, y, rank, name, image, background, border) {

        var cell = new joint.shapes.org.Member({
            position: { x: x, y: y },
            attrs: {
                '.card': { fill: background, stroke: border},
                image: { 'xlink:href': basePath + 'images/sdm/' + image },
                '.rank': { text: rank }, '.name': { text: name }
            }
        });
        graph.addCell(cell);
        return cell;
    };

    function link(source, target, breakpoints) {

        var cell = new joint.shapes.org.Arrow({
            source: { id: source.id },
            target: { id: target.id },
            vertices: breakpoints
        });
        graph.addCell(cell);
        return cell;
    }

    function linkDash(source, target, breakpoints) {

        var cell = new joint.shapes.org.ArrowDash({
            source: { id: source.id },
            target: { id: target.id },
            vertices: breakpoints
        });
        graph.addCell(cell);
        return cell;
    }

    var boxHeight = 65;
    var kepala = member((($profilWidth-100)/4.5), 50,'Ka. UPT RS Paru JBR', '', 'member.png', '#F1C40F', 'gray');
    var KP = member(50,150,'Komite Perawat', '', 'member.png', '#2ECC71', '#008e09');
    var KM = member(50,215,'Komite Medik', '', 'member.png', '#2ECC71', '#008e09');
    var SPI = member(50,280,'SPI' , '', 'member.png', '#2ECC71', '#008e09');
    var KTU = member(($profilWidth-550),325,'KTU', '', 'member.png', '#F32F8F', '#333');
    var UPPE = member(($profilWidth-800),450,'PPE', '', 'member.png', '#3498DB', '#333');
    var UKPSDM = member(($profilWidth-700),450+boxHeight,'Kepegawaian & PSDM', '', 'member.png', '#3498DB', '#333');
    var UKEU = member(($profilWidth-325),450,'Keuangan', '', 'member.png', '#3498DB', '#333');
    var UUMUM = member(($profilWidth-400),450+boxHeight,'Umum', '', 'member.png', '#3498DB', '#333');
    var IS = member(($profilWidth-325),600,'Inst. Sekretariat', '', 'member.png', '#3498DB', '#333');
    var IKK = member(($profilWidth-325),600+boxHeight,'Kebersihan & Kesehatan', '', 'member.png', '#3498DB', '#333');
    var SATPOLPP = member(($profilWidth-325),600+(boxHeight*2),'Inst. Satpol PP', '', 'member.png', '#3498DB', '#333');
    var KOLAYANAN = member(50,950,'Koord. Pelayanan', '', 'member.png', '#eb9316', '#333');
    var KOTUNJANG = member(($profilWidth-850),950,'Koord. Penunjang', '', 'member.png', '#eb9316', '#333');
    var KOPROMLIT = member(($profilWidth-525),950,'Koord. Promlit & Info.', '', 'member.png', '#eb9316', '#333');
    var INSIGD = member(150,1100,'Inst. IGD', '', 'member.png', '#f6f647', '#333');
    var INSRJ = member(150,1100+(boxHeight),'Inst. Rawat Jalan', '', 'member.png', '#f6f647', '#333');
    var INSRI = member(150,1100+(boxHeight*2),'Inst. Rawat Inap', '', 'member.png', '#f6f647', '#333');
    var INSHRL = member(150,1100+(boxHeight*3),'Hiperbarik & Rawat Luka', '', 'member.png', '#f6f647', '#333');
    var INSBCSSD = member(150,1100+(boxHeight*4),'Inst. Bedah & CSSD', '', 'member.png', '#f6f647', '#333');
    var INSAR = member(150,1100+(boxHeight*5),'Anastesi & Reanimasi', '', 'member.png', '#f6f647', '#333');
    var INSRAD = member(($profilWidth-655),1100,'Inst. Radiologi', '', 'member.png', '#ce8483', '#333');
    var INSFAR = member(($profilWidth-655),1100+(boxHeight),'Inst. Farmasi', '', 'member.png', '#ce8483', '#333');
    var INSLAB = member(($profilWidth-655),1100+(boxHeight*2),'Inst. Laboratorium', '', 'member.png', '#ce8483', '#333');
    var INSGIZI = member(($profilWidth-655),1100+(boxHeight*3),'Inst. Gizi', '', 'member.png', '#ce8483', '#333');
    var INSIPRS = member(($profilWidth-655),1100+(boxHeight*4),'Inst. IPRS & Sanitasi', '', 'member.png', '#ce8483', '#333');
    var INSLINEN = member(($profilWidth-655),1100+(boxHeight*5),'Inst. Linen & Loundry', '', 'member.png', '#ce8483', '#333');
    var INSRM = member(($profilWidth-655),1100+(boxHeight*6),'Inst. Rekam Medik', '', 'member.png', '#ce8483', '#333');
    var INSLITBANG = member(($profilWidth-325),1100,'Inst. Litbang & Diklat', '', 'member.png', '#00bb00', '#333');
    var INSPKRS = member(($profilWidth-325),1100+(boxHeight),'Inst. PKRS', '', 'member.png', '#00bb00', '#333');

    linkDash(kepala, KP, [{x: ($profilWidth/3.5), y: 150}, {x: ($profilWidth/3.5), y: 180}]);
    linkDash(kepala, KM, [{x: ($profilWidth/3.5), y: 150}, {x: ($profilWidth/3.5), y: 240}]);
    linkDash(kepala, SPI, [{x: ($profilWidth/3.5), y: 150}, {x: ($profilWidth/3.5), y: 310}]);
    link(kepala, KTU, [{x: ($profilWidth/3.5), y: 150}, {x: ($profilWidth/3.5), y: 355}]);
    link(KTU, UPPE, [{x: ($profilWidth/3.5)+410, y: 425}, {x: ($profilWidth/3.5)+150, y: 425}]);
    link(KTU, UKPSDM, [{x: ($profilWidth/3.5)+410, y: 425}, {x: ($profilWidth/3.5)+300, y: 425}]);
    link(KTU, UKEU, [{x: ($profilWidth/3.5)+410, y: 425}, {x: ($profilWidth/3.5)+600, y: 425}]);
    link(KTU, UUMUM, [{x: ($profilWidth/3.5)+410, y: 425}, {x: ($profilWidth/3.5)+500, y: 425}]);
    link(KTU, IS, [{x: ($profilWidth/3.5)+410, y: 630}, {x: ($profilWidth/3.5)+410, y: 630}]);
    link(KTU, IKK, [{x: ($profilWidth/3.5)+410, y: 630+(boxHeight)}, {x: ($profilWidth/3.5)+410, y: 630+(boxHeight)}]);
    link(KTU, SATPOLPP, [{x: ($profilWidth/3.5)+410, y: 630+(boxHeight*2)}, {x: ($profilWidth/3.5)+410, y: 630+(boxHeight*2)}]);
    link(kepala, KOLAYANAN, [{x: ($profilWidth/3.5), y: 850}, {x: ($profilWidth/3.5)-175, y: 850}]);
    link(kepala, KOTUNJANG, [{x: ($profilWidth/3.5), y: 850}, {x: ($profilWidth/3.5)+150, y: 850}]);
    link(kepala, KOPROMLIT, [{x: ($profilWidth/3.5), y: 850}, {x: ($profilWidth/3.5)+455, y: 850}]);
    var yellowHeight = 1130;
    link(KOLAYANAN, INSIGD, [{x: 100, y: yellowHeight}, {x: 125, y: yellowHeight}]);
    link(KOLAYANAN, INSRJ, [{x: 100, y: yellowHeight+boxHeight}, {x: 125, y: yellowHeight+boxHeight}]);
    link(KOLAYANAN, INSRI, [{x: 100, y: yellowHeight+(boxHeight*2)}, {x: 125, y: yellowHeight+(boxHeight*2)}]);
    link(KOLAYANAN, INSHRL, [{x: 100, y: yellowHeight+(boxHeight*3)}, {x: 125, y: yellowHeight+(boxHeight*3)}]);
    link(KOLAYANAN, INSBCSSD, [{x: 100, y: yellowHeight+(boxHeight*4)}, {x: 125, y: yellowHeight+(boxHeight*4)}]);
    link(KOLAYANAN, INSAR, [{x: 100, y: yellowHeight+(boxHeight*5)}, {x: 125, y: yellowHeight+(boxHeight*5)}]);
    link(KOTUNJANG, INSRAD, [{x: ($profilWidth/3.5)+100, y: yellowHeight}, {x: ($profilWidth/3.5)+150, y: yellowHeight}]);
    link(KOTUNJANG, INSFAR, [{x: ($profilWidth/3.5)+100, y: yellowHeight+boxHeight}, {x: ($profilWidth/3.5)+150, y: yellowHeight+boxHeight}]);
    link(KOTUNJANG, INSLAB, [{x: ($profilWidth/3.5)+100, y: yellowHeight+(boxHeight*2)}, {x: ($profilWidth/3.5)+150, y: yellowHeight+(boxHeight*2)}]);
    link(KOTUNJANG, INSGIZI, [{x: ($profilWidth/3.5)+100, y: yellowHeight+(boxHeight*3)}, {x: ($profilWidth/3.5)+150, y: yellowHeight+(boxHeight*3)}]);
    link(KOTUNJANG, INSIPRS, [{x: ($profilWidth/3.5)+100, y: yellowHeight+(boxHeight*4)}, {x: ($profilWidth/3.5)+150, y: yellowHeight+(boxHeight*4)}]);
    link(KOTUNJANG, INSLINEN, [{x: ($profilWidth/3.5)+100, y: yellowHeight+(boxHeight*5)}, {x: ($profilWidth/3.5)+150, y: yellowHeight+(boxHeight*5)}]);
    link(KOTUNJANG, INSRM, [{x: ($profilWidth/3.5)+100, y: yellowHeight+(boxHeight*6)}, {x: ($profilWidth/3.5)+150, y: yellowHeight+(boxHeight*6)}]);
    link(KOPROMLIT, INSLITBANG, [{x: ($profilWidth/3.5)+455, y: yellowHeight}, {x: ($profilWidth/3.5)+455, y: yellowHeight}]);
    link(KOPROMLIT, INSPKRS, [{x: ($profilWidth/3.5)+455, y: yellowHeight+boxHeight}, {x: ($profilWidth/3.5)+455, y: yellowHeight+boxHeight}]);

});