<!-- START FOOTER -->
<div id="footer-section">
    <div class="footer">
        <div class="row">
            <div class="col-lg-3 offset-lg-2 footer-info pt-5 mt-5">
                <span>Kontak Kami :</span>
                <h4>Kantor Bupati Bojonegoro</h4>
                <p>Jl. P. Mastumapel No. 1, Bojonegoro - Jawa Timur</p>
                <p>Telp. 0353 - 881826 / 0353 - 881454</p>
                <p>Fax. 0353 - 884893 / 0353 - 882378 / 0353 - 887206</p>
                <p>pemkab@bojonegorokab.go.id</p>
                <p>dinkominfo@bojonegorokab.go.id</p>
            </div>
        </div>
    </div>
</div>
<!-- END FOOTER -->
<!-- START COPYRIGHT -->
<div id="copy-section">
    <div class="copy">
        <div class="row">
            <div class="col-lg-5">
                <span class="copyright">Copyright 2020 | PEMKAB BOJONEGORO</span>
            </div>
            <div class="col-lg-7">
                        <span class="float-right">
                            Statistik:<br/>
                            <small>Hari ini : {{ $valStatistic = Statistik::getDailyStatistik() }}</small>
                            <small>Bulan ini : {{ $valStatisticMonth = Statistik::getMonthlyStatistik() }}</small>
                            <small>Tahun ini : {{ $valStatisticYear = Statistik::getYearlyStatistik() }}</small>
                        </span>
            </div>
        </div>
    </div>
</div>
