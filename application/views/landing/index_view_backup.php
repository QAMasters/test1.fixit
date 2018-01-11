<?php
$xheader = '
<link href="./assets1/css/landing.css" rel="stylesheet" type="text/css"/>
';
$xfooter = '
<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
';
include 'header.php';
?>
<body data-spy="scroll" data-target="#header">
<nav id="header" class="navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="#">FiXiT</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="#home"><?php echo $this->lang->line('home'); ?></a></li>
                <li><a href="#howitworks"><?php echo $this->lang->line('how_it_works'); ?></a></li>
                <li><a href="#section-2"><?php echo $this->lang->line('services'); ?></a></li>
                <li><a href="#track"><?php echo $this->lang->line('track'); ?></a></li>
                <li><a href="#" data-toggle="modal" data-target="#Login"><?php echo $this->lang->line('login'); ?></a>
                </li>
                <li class="dropdown">
                    <?php
                    if ($pref_lang == 'en') {
                        echo '<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="false"><img src="' . base_url() . 'assets/img/flags/us.png" width="20px" height="15px"> EN <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="#" id="lang"><img src="' . base_url() . 'assets/img/flags/sw.png" width="20px" height="20px"> SW</a></li></ul>';
                        $new_lang = 'sw';

                    } else if ($pref_lang == 'sw') {
                        echo '<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="false"><img src="' . base_url() . 'assets/img/flags/sw.png" width="20px" height="15px"> SW <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="#" id="lang"><img src="' . base_url() . 'assets/img/flags/us.png" width="20px" height="20px"> EN</a></li></ul>';
                        $new_lang = 'en';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="home" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="home-text col-md-8">
                <h1 class="wow fadeInDown" data-wow-delay="1.5s" data-wow-duration="1.5s"
                    data-wow-offset="10"><?php echo $this->lang->line('main_lbl'); ?></h1>

                <p class="lead wow fadeInDown" data-wow-delay="2s" data-wow-duration="1.5s" data-wow-offset="10"></p>

                <a href="create-ticket" class="btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s"
                   data-wow-duration="1.5s" data-wow-offset="10"> <i
                            class="fa fa-share faa-flash animated"></i> <?php echo $this->lang->line('raise_ticket'); ?>
                </a>
            </div>

        </div>
    </div>
</div>

<div class="container" id="howitworks">
    <div class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
        <h1 align="center" style="padding-top: 1cm;"><?php echo $this->lang->line('how_it_works'); ?></h1>
    </div>
    <div class="row features-list" style="padding-top: 1cm;">
        <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
            <div class="feature-icon">
                <span aria-hidden="true" class="icon-user-following"></span>
            </div>
            <h2><?php echo $this->lang->line('raise_a_ticket'); ?></h2>
            <p><?php echo $this->lang->line('raise_a_ticket_lbl'); ?></p>
        </div>
        <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.7s">
            <div class="feature-icon">
                <span aria-hidden="true" class="icon-speedometer"></span>
            </div>
            <h2><?php echo $this->lang->line('schedule'); ?></h2>
            <p><?php echo $this->lang->line('schedule_lbl'); ?></p>
        </div>
        <div class="col-sm-4 wow fadeInRight" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.9s">
            <div class="feature-icon">
                <span aria-hidden="true" class="icon-emoticon-smile"></span>
            </div>
            <h2><?php echo $this->lang->line('relax'); ?></h2>
            <p><?php echo $this->lang->line('relax_lbl'); ?></p>
        </div>
        <div style="padding-top: 0.5cm;" class="wow fadeInRight" data-wow-duration="1.5s" data-wow-offset="10"
             data-wow-delay="0.5s">
            <p align="center"></p>
        </div>
    </div>
</div>

<section id="section-2">
    <div class="container">
        <div class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
            <h1 align="center" style="padding-bottom: 1cm;"><?php echo $this->lang->line('our_pop_service'); ?></h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 col-sm-11 col-sm-offset-1 col-lg-offset-1 text-center">
                <div class="col-md-3">
                    <div class="thumbnail wow rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10"
                         data-wow-delay="0.5s">
                        <a href="create-ticket?service=Apartment">
                            <img src="<?php base_url() ?>assets/img/services/apartment.jpg" style="width: 100%"
                                 alt="Gallery Image">
                            <div class="caption"><h3><?php echo $this->lang->line('apartment'); ?></h3></div>
                        </a>
                    </div>
                </div> <!-- /.col -->
                <div class="col-md-3">
                    <div class="thumbnail wow rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10"
                         data-wow-delay="0.5s">
                        <a href="create-ticket?service=Bathroom">
                            <img src="<?php base_url() ?>assets/img/services/bedroom.jpg" style="width: 100%"
                                 alt="Gallery Image">
                            <div class="caption"><h3><?php echo $this->lang->line('bathroom'); ?></h3></div>
                        </a>
                    </div>
                </div> <!-- /.col -->
                <div class="col-md-3">
                    <div class="thumbnail wow rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10"
                         data-wow-delay="0.5s">
                        <a href="create-ticket?service=Hall">
                            <img src="<?php base_url() ?>assets/img/services/hall.jpg" style="width: 100%"
                                 alt="Gallery Image">
                            <div class="caption"><h3><?php echo $this->lang->line('hall'); ?></h3></div>
                        </a>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.col big-->
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 col-sm-11 col-sm-offset-1 col-lg-offset-1 text-center">
                <div class="col-md-3">
                    <div class="thumbnail wow rotateInUpRight" data-wow-duration="1.5s" data-wow-offset="10"
                         data-wow-delay="0.5s">
                        <a href="create-ticket?service=Kitchen">
                            <img src="<?php base_url() ?>assets/img/services/kitchen.jpg" style="width: 100%"
                                 alt="Gallery Image">
                            <div class="caption"><h3><?php echo $this->lang->line('kitchen'); ?></h3></div>
                        </a>
                    </div>
                </div> <!-- /.col -->
                <div class="col-md-3">
                    <div class="thumbnail wow rotateInUpRight" data-wow-duration="1.5s" data-wow-offset="10"
                         data-wow-delay="0.5s">
                        <a href="create-ticket?service=Bedroom">
                            <img src="<?php base_url() ?>assets/img/services/bedroom.jpg" style="width: 100%"
                                 alt="Gallery Image">
                            <div class="caption"><h3><?php echo $this->lang->line('bedroom'); ?></h3></div>
                        </a>
                    </div>
                </div> <!-- /.col -->
                <div class="col-md-3">
                    <div class="thumbnail wow rotateInUpRight" data-wow-duration="1.5s" data-wow-offset="10"
                         data-wow-delay="0.5s">
                        <a href="create-ticket?service=Living room">
                            <img src="<?php base_url() ?>assets/img/services/livingroom.jpg" style="width: 100%"
                                 alt="Gallery Image">
                            <div class="caption"><h3><?php echo $this->lang->line('living_room'); ?></h3></div>
                        </a>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.col big -->
        </div>
    </div>
</section>

<div class="container" id="track">
    <div class="container" style="padding-top: 1cm; padding-bottom: 1cm;">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-3 wow rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10"
                 data-wow-delay="0.5s">
                <h2><?php echo $this->lang->line('track_ur_ticket'); ?></h2>
                <form class="form-inline" method="GET" action="track-ticket" data-toggle="validator">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">Ticket ID</label>
                        <input type="text" class="form-control input-lg"
                               placeholder="<?php echo $this->lang->line('ticket_id'); ?>" name="ticket_id" required="">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">Phone</label>
                        <div class="input-group m-d"><span class="input-group-addon">+46</span>
                            <input type="number" class="form-control input-lg"
                                   placeholder="<?php echo $this->lang->line('phold_phone'); ?>" name="phone"
                                   oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 0) ? (1/1) : this.value;"
                                   maxlength="10" min="0" required data-minlength="10">
                        </div>

                    </div>
                    <button type="submit"
                            class="btn btn-success btn-lg"><?php echo $this->lang->line('track'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="contact">
    <div class="container">
        <div class="row text-left">
            <div class="col-sm-4">
                <div class="heading-block">
                    <h3>F i X i T</h3>
                </div>
                <!-- /.heading-block -->
                <p><?php echo $this->lang->line('footer_desc'); ?></p>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                <div class="heading-block">
                    <h3><?php echo $this->lang->line('keep_in_touch'); ?></h3>
                </div>
                <!-- /.heading-block -->
                <ul class="list-unstyled">
                    <li><p><i class="fa fa-map-marker m-r-xs"></i>Solna, Stockholm</p></li>
                    <li><p><i class="fa fa-envelope m-r-xs"></i><a href="mailto:info@reitsolution.se">info@reitsolution.se</a>
                        </p></li>
                    <li><p><i class="fa fa-phone m-r-xs"></i><a href="tel:">+46</a></p></li>
                </ul>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                <div class="heading-block">
                    <h3><?php echo $this->lang->line('connect_with_us'); ?></h3>
                </div>
                <!-- /.heading-block -->
                <ul class="list-unstyled">
                    <div class="btn-group btn-group-justified m-t-sm" role="group" aria-label="Justified button group">
                        <li><a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a></li>
                        <li><a href="#" class="btn btn-google"><i class="fa fa-google-plus"></i> Google+</a></li>
                    </div>
                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<?php include 'footer.php'; ?>

</body>
</html>
<!-- Localized -->

<script type="text/javascript">
    $('#lang').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "change-lang?lang=<?php echo $new_lang; ?>",
            type: "GET",//type of posting the data
            success: function (data) {
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //what to do in error
            },
            timeout: 15000//timeout of the ajax call
        });

    });
</script>

<!-- Modal -->
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('login'); ?></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="login">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                               placeholder="<?php echo $this->lang->line('enter_email'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><?php echo $this->lang->line('password'); ?></label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                               placeholder="Password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                <button type="submit" class="btn btn-success"><?php echo $this->lang->line('login'); ?></button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //shortcut for $(document).ready
    $(function () {
        if (window.location.hash) {
            var hash = window.location.hash;
            $(hash).modal('toggle');
        }
    });
</script>