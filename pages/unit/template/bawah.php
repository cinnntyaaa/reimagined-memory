<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2021 <div class="bullet"></div> <span class="text-white">Design By <a href="https://github.com/cinnntyaaa/" class="text-white" target="_blank">bucin</a></span>
    </div>
    <div class="footer-right">
        2.3.0
    </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<!-- <script src="../../assets/js/jquery-3.5.1.min.js"></script> -->
<script src="../../assets/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="../../assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../../assets/js/jquery.nicescroll.min.js"></script>
<script src="../../assets/js/moment.min.js"></script>
<script src="../../assets/js/stisla.js"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="../../assets/js/scripts.js"></script>
<script src="../../assets/js/custom.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>


<script>
    $(".coba").each(function() {
        var nav = $(this);
        var hrep = nav.find("a");
        if (hrep.attr("href") == location.pathname) {
            nav.addClass("active");
        }
    })
    $(".hadeh").each(function() {
        var navItem = $(this);
        var href = navItem.find("a");
        href.each(function(href) {
            var all_href = $(this);
            if (all_href.attr("href") == location.pathname) {
                navItem.addClass("active");
            } else {
                if (all_href.attr("href") == "#") {
                    for (var i = 0; i < $('.coba').length; i++) {
                        var html = $('.coba').find("a");
                        for (var i = 0; i < html.length; i++);
                        var html2 = html[i]
                        if ($(html2).attr("href") == location.pathname) {
                            navItem.addClass("active");
                        }
                    }
                }
            }
        })
    })
</script>