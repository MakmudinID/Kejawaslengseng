<!DOCTYPE html>
<html lang="en">

<head>
    <title>MAINTENANCE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url('assets/maintenance'); ?>/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/maintenance'); ?>/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/maintenance'); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/maintenance'); ?>/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/maintenance'); ?>/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/maintenance'); ?>/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/maintenance'); ?>/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <!--  -->
    <div class="simpleslide100">
        <div class="simpleslide100-item bg-img1" style="background-image: url('<?= base_url('assets/maintenance/'); ?>images/bg01.jpg');"></div>
        <div class="simpleslide100-item bg-img1" style="background-image: url('<?= base_url('assets/maintenance/'); ?>images/bg02.jpg');"></div>
    </div>

    <div class="flex-col-c-sb size1 overlay1">
        <!--  -->
        <div class="w-full flex-w flex-sb-m p-l-80 p-r-80 p-t-22 p-lr-15-sm">
            <div class="wrappic1 m-r-30 m-t-10 m-b-10">
                <a href="#"><img src="<?= base_url('assets/'); ?>logo_tajeer.jpg" alt="LOGO"></a>
            </div>


        </div>


        <div class="flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-120">
            <h3 class="l1-txt1 txt-center p-b-40 respon1">
                Kita Libur Dulu Yaa
            </h3>

            <h3 class="l1-txt1 txt-center p-b-40 respon1">
                <strong> Toko kembali buka pada tanggal</strong>
            </h3>

            <div class="flex-w flex-c-m cd100">
                <div class="flex-col-c wsize1 m-b-30">
                    <span class="l1-txt2 p-b-9 days">03</span>
                    <!--<span class="s1-txt1 where1 p-l-35">Days</span>-->
                </div>

                <div class="flex-col-c wsize1 m-b-30 mr-5">
                    <span class="l1-txt2 p-b-9 hours">06</span>
                    <!--<span class="s1-txt1 where1 p-l-35">Juni</span>-->
                </div>

                <div class="flex-col-c wsize1 m-b-30 ml-5">
                    <span class="l1-txt2 p-b-9 minutes">2020</span>
                    <!--<span class="s1-txt1 where1 p-l-35">Minutes</span>-->
                </div>

                <div class="flex-col-c wsize1 m-b-30">
                    <!--<span class="l1-txt2 p-b-9 seconds">2020</span>-->
                    <!--<span class="s1-txt1 where1 p-l-35">Seconds</span>-->
                </div>
            </div>
        </div>

        <!--  -->
        <div class="flex-w flex-c-m p-b-35">
            <!-- <a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-facebook"></i>
            </a>

            <a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-twitter"></i>
            </a>

            <a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-youtube-play"></i>
            </a> -->
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/countdowntime/moment.min.js"></script>
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/countdowntime/moment-timezone.min.js"></script>
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/countdowntime/countdowntime.js"></script>
    <script>
        $('.cd100').countdown100({
            /*Set Endtime here*/
            /*Endtime must be > current time*/
            endtimeYear: 0,
            endtimeMonth: 0,
            endtimeDate: 0,
            endtimeHours: 0,
            endtimeMinutes: 0.5,
            endtimeSeconds: 0,
            timeZone: ""
            // ex:  timeZone: "America/New_York"
            //go to " http://momentjs.com/timezone/ " to get timezone
        });
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/maintenance'); ?>/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/maintenance'); ?>/js/main.js"></script>

</body>

</html>