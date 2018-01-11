<?php
$this->db->where('id =', $this->session->id);
$query = $this->db->get('users')->row();
$pref_lang = $query->pref_lang;
$profilepic = $query->profilepic;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo site_data()->title;?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <?php echo $xheader; ?>

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    
<style>
.highlight {
    background-color: #eda8af;
}
</style>

</head>

<body class="">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" width="100" height="100" src="<?php echo !empty($profilepic) ? base_url().'uploads/users/'.$profilepic : base_url().'uploads/users/default.png'; ?>?rand=<?php echo rand();?>" />

                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->fname.' '.$this->session->lname; ?></strong>
                             </span> 
                             <?php
                             if($this->session->role_id == 1){
                                echo '<span class="text-muted text-xs block">Administrator <b class="caret"></b></span>';
                             }else if($this->session->role_id == 2){
                                echo '<span class="text-muted text-xs block">Vendor <b class="caret"></b></span>';
                             }
                             ?>
                             </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo base_url(); ?>profile"><?php echo $this->lang->line('profile');?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>logout"><?php echo $this->lang->line('logout');?></a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        F
                    </div>
                </li>
                <li class="<?php if($this->uri->segment(1) == 'dashboard'){ echo 'active'; }?>">
                        <a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> <span class="nav-label"><?php echo $this->lang->line('dashboard');?></span></a>
                    </li>
                    <li class="<?php if($this->uri->segment(1) == 'tickets'){ echo 'active'; }?>">
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label"><?php echo $this->lang->line('tickets');?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo base_url() ?>tickets/drafts"><?php echo $this->lang->line('draft_tickets');?><span class="label label-info pull-right"><?php echo draft_tic_count(); ?></span></a></li>
                            <?php 
                            if($this->session->role_id == 2){ ?>
                            <li><a href="<?php echo base_url() ?>tickets/me"><?php echo $this->lang->line('my_tickets');?><span class="label label-success pull-right"><?php echo my_tic_count(); ?></span></a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url() ?>tickets/open"><?php echo $this->lang->line('open_tickets');?><span class="label label-primary pull-right"><?php echo open_tickets_count(); ?></span></a></li>
                            <li><a href="<?php echo base_url() ?>tickets/closed"><?php echo $this->lang->line('closed_tickets');?><span class="label label-warning pull-right"><?php echo closed_tickets_count(); ?></span></a></li>
                            <li><a href="<?php echo base_url() ?>tickets/deleted"><?php echo $this->lang->line('deleted_tickets');?><span class="label label-default pull-right"><?php echo deleted_tickets_count(); ?></span></a></li>
                            <li><a href="<?php echo base_url() ?>tickets/history"><?php echo $this->lang->line('ticket_history');?></a></li>
                            <li><a href="<?php echo base_url() ?>tickets/new"><?php echo $this->lang->line('create_new_ticket');?></a></li>
                        </ul>
                    </li>
                    <?php if($this->session->role_id == 1){ ?>
                    <li class="<?php if($this->uri->segment(1) == 'vendors' OR $this->uri->segment(1) == 'vendor'){ echo 'active'; }?>">
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label"><?php echo $this->lang->line('vendor_management');?></span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo base_url() ?>vendors/new"><?php echo $this->lang->line('add_vendor');?></a></li>
                            <li><a href="<?php echo base_url() ?>vendors/active"><?php echo $this->lang->line('active_vendors');?><span class="label label-primary pull-right"><?php echo vendor_active_count(); ?></span></a></li>
                            <li><a href="<?php echo base_url() ?>vendors/inactive"><?php echo $this->lang->line('inact_vendors');?><span class="label label-warning pull-right"><?php echo vendor_inactive_count(); ?></span></a></li>
                        </ul>
                    </li>
                    <li class="<?php if($this->uri->segment(1) == 'invoice'){ echo 'active'; }?>">
                        <a href="#"><i class="fa fa-file-o"></i> <span class="nav-label"><?php echo $this->lang->line('invoices');?></span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo base_url() ?>invoice/requested"><?php echo $this->lang->line('invoice_requested');?></a></li>
                            <li><a href="<?php echo base_url() ?>invoice/list"><?php echo $this->lang->line('invoice_list');?></a></li>
                            <!--<li><a href="<?php echo base_url() ?>invoice/create"><?php echo $this->lang->line('create_invoice');?></a></li>-->
                        </ul>
                    </li>
                    
					<li class="<?php if($this->uri->segment(1) == 'settings'){ echo 'active'; }?>">
                        <a href="#"><i class="fa fa-cog"></i><span class="nav-label"><?php echo $this->lang->line('settings');?></span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo base_url() ?>settings/appconfig"><?php echo $this->lang->line('app_config');?></a></li>
                            <li><a href="<?php echo base_url() ?>settings/ticket-config"><?php echo $this->lang->line('ticket_config');?></a></li>
                            <li><a href="<?php echo base_url() ?>settings/email-templates"><?php echo $this->lang->line('email_templates');?></a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="<?php if($this->uri->segment(1) == 'calendar'){ echo 'active'; }?>">
                        <a href="<?php echo base_url() ?>calendar"><i class="fa fa-calendar"></i><span class="nav-label"><?php echo $this->lang->line('calendar');?></span></a>
                    </li>
                    <?php if($this->session->role_id == 1){ ?>
                    <li class="<?php if($this->uri->segment(1) == 'backup'){ echo 'active'; }?>">
                        <a href="<?php echo base_url() ?>backup"><i class="fa fa-database"></i><span class="nav-label"><?php echo $this->lang->line('backup');?></span></a>
                    </li>
                    <?php } ?>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!--<form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>-->
        </div>

            <ul class="nav navbar-top-links navbar-right">
                
                <div class="btn-group">
                <a href="<?php echo base_url(); ?>tickets/new" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line('new_ticket');?></a>
                </div>

                <div class="btn-group">
                <?php if($pref_lang == '1'){
                    echo '<button data-toggle="dropdown" class="btn btn-default btn-s dropdown-toggle" aria-expanded="false"><img src="'.base_url().'assets/img/flags/us.png"></img> En <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="'.base_url().'language/sw"><img src="'.base_url().'assets/img/flags/sw.png"> Sw</a></li>
                    </ul>';                    
                }else if($pref_lang == '2'){
                    echo '<button data-toggle="dropdown" class="btn btn-default btn-s dropdown-toggle" aria-expanded="false"><img src="'.base_url().'assets/img/flags/sw.png"></img> Sw <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="'.base_url().'language/en"><img src="'.base_url().'assets/img/flags/us.png"> En</a></li>
                    </ul>';
                }
                ?>
                </div>
                <?php if($this->session->role_id == 1){ ?>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-file-text-o"></i>  <span class="label label-danger"><?php echo alert_invoices_count(); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        
                        <?php
                        if(alert_invoices_count() != '0'){
                        foreach (alert_invoices() as $alert_invoice) {
                            echo '<li><a href="'.base_url().'invoices/requested"><div><i class="fa fa-file-text-o"></i> '.$alert_invoice->ticket_id.'<span class="pull-right text-muted small"></span></div></a></li><li class="divider"></li>';
                        }
                        }
                            ?>
                        <li>
                            <div class="text-center link-block">
                                <a href="<?php echo base_url()?>invoice/requested">
                                    <strong><?php echo $this->lang->line('all_alerts');?></strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-ticket"></i>  <span class="label label-danger"><?php echo alert_tickets_count(); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        
                        <?php
                        if(alert_tickets_count() != '0'){
                            foreach (alert_tickets() as $alert_ticket) {
                                if($alert_ticket->emergency == '1'){
                                    $highlight = 'highlight';
                                }else{
                                    $highlight = '';
                                }
                                echo '<li><a class="'.$highlight.'" href="'.base_url().'tickets/'.$alert_ticket->ticket_id.'"><div><i class="fa fa-ticket"></i> '.$alert_ticket->ticket_id.'<span class="pull-right text-muted small">'.$alert_ticket->updated.'</span></div></a></li><li class="divider"></li>';
                            } 
                        }
                            ?>
                        <li>
                            <div class="text-center link-block">
                                <a href="<?php echo base_url()?>tickets/open">
                                    <strong><?php echo $this->lang->line('all_alerts');?></strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="<?php echo base_url(); ?>logout">
                        <i class="fa fa-sign-out"></i> <?php echo $this->lang->line('logout');?>
                    </a>
                </li>
            </ul>

        </nav>
        </div>