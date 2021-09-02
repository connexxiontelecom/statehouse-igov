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
                                <a href="javascript:void(0)" class="text-reset"><?= $emp['employee_f_name'] ?? '' ?> <?= $emp['employee_l_name'] ?? '' ?></a>
                            </h5>
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
                                <a href="javascript:void(0)" class="text-reset selected-user"><?= $emp['employee_f_name'] ?? '' ?> <?= $emp['employee_l_name'] ?? '' ?></a>
                            </h5>
                        </div>
                        <div>
                            <a href="javascript: void(0);" class="text-reset font-19 py-1 px-2 d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clear Chat">
                                <i class="fe-trash-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   <div id="chatWrapper"></div>

                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                                <form class="needs-validation" novalidate="" name="chat-form" id="chat-form">
                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <input type="hidden" id="hidden-selected">
                                            <input type="text" class="form-control border-0 chat-message" placeholder="Enter your text" required="">
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
<script src="/assets/js/axios.min.js"></script>
<script>
    $(document).ready(function(){
        $(".employee-wrapper").on('click',function(e) {
            e.preventDefault();
            var user = $(this).data('emp');
            if(user != ''){
                $('.selected-user').text($(this).data('name'));
                $('#hidden-selected').val($(this).data('emp'));
                axios.post('/chat-messages', {
                    user:user
                })
               .then(response=>{
                   $('#chatWrapper').html(response.data);
                   //console.log('Hello');
               })
                .catch(error=>{
                    console.log(error);
                });
            }

            //$(this).off('click');
        });
        $(document).on('click', '.chat-send', function(e){
            e.preventDefault();
            var message = $('.chat-message').val();
            var user = $('#hidden-selected').val();
            axios.post('/send-message', {message:message, user:user})
            .then(response=>{
                $('#chatWrapper').html(response.data);
            })
            .catch(error=>{
                console.log('error');
            });
        });
    });

    function getConversations(user_id){
        axios.post('/chat-messages', {user:user_id})
            .then(response=>{
                $('.selected-user').text($(this).data('name'));
                $('#hidden-selected').val($(this).data('emp'));
                $('#chatWrapper').html(response.data);
            });
    }
</script>
<?= $this->endSection(); ?>
