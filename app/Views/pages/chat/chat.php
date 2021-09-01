<?= $this->extend('layouts/master'); ?>

<?= $this->section('extra-styles') ?>
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endsection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Chat</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Chat</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- start chat users-->
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">

                    <div class="media mb-3">
                        <img src="../assets/images/users/user-1.jpg" class="mr-2 rounded-circle" height="42" alt="Brandon Smith">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="contacts-profile.html" class="text-reset">Geneva McKnight</a>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-14">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
                            <a href="javascript: void(0);" class="text-reset font-20">
                                <i class="mdi mdi-cog-outline"></i>
                            </a>
                        </div>
                    </div>

                    <!-- start search box -->
                    <form class="search-bar mb-3">
                        <div class="position-relative">
                            <input type="text" class="form-control form-control-light" placeholder="People, groups &amp; messages...">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>

                    <h6 class="font-13 text-muted text-uppercase mb-2">Contacts</h6>

                    <!-- users -->
                    <div class="row">
                        <div class="col">
                            <div data-simplebar="init" style="max-height: 375px">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer">

                                        </div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <?php foreach($employees as $employee): ?>
                                                    <a href="javascript:void(0);"  data-name="<?= $employee['employee_f_name'] ?? '' ?> <?= $employee['employee_l_name'] ?>" data-emp="<?= $employee['employee_id'] ?>" class="text-body employee-wrapper">
                                                        <div class="media p-2">
                                                            <img src="/assets/images/users/user-2.jpg" class="mr-2 rounded-circle" height="42" alt="Brandon Smith">
                                                            <div class="media-body">
                                                                <h5 class="mt-0 mb-0 font-14">
                                                                    <?= $employee['employee_f_name'] ?? '' ?> <?= $employee['employee_l_name'] ?>
                                                                </h5>
                                                                <p class="mt-1 mb-0 text-muted font-14">
                                                                    <span class="w-75"><?= $employee['employee_level'] ?? '' ?></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 736px;">
                                    </div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar" style="height: 191px; transform: translate3d(0px, 0px, 0px); display: block;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">

            <div class="card">
                <div class="card-body py-2 px-3 border-bottom border-light">
                    <div class="media py-1">
                        <img src="/assets/images/users/user-5.jpg" class="mr-2 rounded-circle" height="36" alt="Brandon Smith">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="contacts-profile.html" class="text-reset">James Zavel</a>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
                            <a href="javascript: void(0);" class="text-reset font-19 py-1 px-2 d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clear Chat">
                                <i class="fe-trash-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar="init" style="max-height: 460px"><div class="simplebar-wrapper" style="margin: 0px -15px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 15px;">
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-5.jpg" class="rounded" alt="James Z">
                                                    <i>10:00</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>James Z</i>
                                                        <p>
                                                            Hello!
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-1.jpg" class="rounded" alt="Geneva M">
                                                    <i>10:01</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Geneva M</i>
                                                        <p>
                                                            Hi, How are you? What about our next meeting?
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-5.jpg" class="rounded" alt="James Z">
                                                    <i>10:01</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>James Z</i>
                                                        <p>
                                                            Yeah everything is fine
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-1.jpg" class="rounded" alt="Geneva M">
                                                    <i>10:02</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Geneva M</i>
                                                        <p>
                                                            Wow that's great
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-5.jpg" alt="James Z" class="rounded">
                                                    <i>10:02</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>James Z</i>
                                                        <p>
                                                            Let's have it today if you are free
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-1.jpg" alt="Geneva M" class="rounded">
                                                    <i>10:03</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Geneva M</i>
                                                        <p>
                                                            Sure thing! let me know if 2pm works for you
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-5.jpg" alt="James Z" class="rounded">
                                                    <i>10:04</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>James Z</i>
                                                        <p>
                                                            Sorry, I have another meeting scheduled at 2pm. Can we have it
                                                            at 3pm instead?
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-5.jpg" alt="James Z" class="rounded">
                                                    <i>10:04</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>James Z</i>
                                                        <p>
                                                            We can also discuss about the presentation talk format if you have some extra mins
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="../assets/images/users/user-1.jpg" alt="Geneva M" class="rounded">
                                                    <i>10:05</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Geneva M</i>
                                                        <p>
                                                            3pm it is. Sure, let's discuss about presentation format, it would be great to finalize today.
                                                            I am attaching the last year format and assets here...
                                                        </p>
                                                    </div>
                                                    <div class="card mt-2 mb-1 shadow-none border text-left">
                                                        <div class="p-2">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <div class="avatar-sm">
                                                                        <span class="avatar-title bg-primary rounded">
                                                                            .ZIP
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col pl-0">
                                                                    <a href="javascript:void(0);" class="text-muted font-weight-bold">UBold-sketch.zip</a>
                                                                    <p class="mb-0">2.3 MB</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <!-- Button -->
                                                                    <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                                                                        <i class="dripicons-download"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-actions dropdown">
                                                    <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy Message</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 850px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 248px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></ul>

                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                                <form class="needs-validation" novalidate="" name="chat-form" id="chat-form">
                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <input type="text" class="form-control border-0" placeholder="Enter your text" required="">
                                            <div class="invalid-feedback">
                                                Please enter your message
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-light"><i class="fe-paperclip"></i></a>
                                                <button type="submit" class="btn btn-success chat-send btn-block"><i class="fe-send"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script>
    $(document).ready(function(){
        $(document).on('click', '.employee-wrapper', function(e){
            alert('Emp:'+$(this).data('emp')+" Name: "+$(this).data('name'));
        });
    });
</script>
<?= $this->endSection(); ?>
