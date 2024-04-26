<?php
    $setting = App\Models\SiteSettng::findOrFail('1');
    if(Auth::user())
    {
        $user_id = Auth::user()->id;
        $chats = App\Models\Chatbot::where('user_id',$user_id)->orWhere('to_user',$user_id)->get();
    }

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Gaia - Real Estate</title>
    <meta name="author" content="Gaia">
    <meta name="description" content="Gaia - Real Estate">
    <meta name="keywords" content="Gaia - Real Estate">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->

    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e($setting->getFirstMediaUrl('fev_image')); ?>">
    <link rel="manifest" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(url('frontend')); ?>/assets/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
 Google Fonts
 ============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@100;200;300;400;600;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!--==============================
 All CSS File
 ============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/style.css">

    <style>
        .header-top,
        .header-links {
            font-family: var(--para-font);
            background-color: #D4AF37;
        }

        .users_class:before {
            content: '' !important;
        }

        .chatbot__button {
            position: fixed;
            bottom: 35px;
            right: 40px;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #d4af37;
            color: #f3f7f8;
            border: none;
            border-radius: 50%;
            outline: none;
            z-index: 10;
            cursor: pointer;
        }

        .chatbot__button span {
            position: absolute;
        }

        .show-chatbot .chatbot__button span:first-child,
        .chatbot__button span:last-child {
            opacity: 0;
        }

        .show-chatbot .chatbot__button span:last-child {
            opacity: 1;
        }

        .chatbot {
            position: fixed;
            bottom: 0px;
            right: 0px;
            width: 420px;
            background-color: #f3f7f8;
            border-radius: 15px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1) 0 32px 64px -48px rgba(0, 0, 0, 0.5);
            transform: scale(0.5);
            transition: transform 0.3s ease;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .show-chatbot .chatbot {
            opacity: 1;
            pointer-events: auto;
            transform: scale(0.7);
            z-index: 10;
            background-color: #323232;
        }

        .chatbot__header {
            position: relative;
            background-color: #d4af37;
            text-align: center;
            padding: 16px 0;
        }

        .chatbot__header span {
            display: none;
            position: absolute;
            top: 50%;
            right: 20px;
            color: #202020;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .chatbox__title {
            font-size: 1.4rem;
            color: #f3f7f8;
        }

        .chatbot__box {
            height: 510px;
            overflow-y: auto;
            padding: 30px 20px 100px;
        }

        .chatbot__chat {
            display: flex;
        }

        .chatbot__chat p {
            max-width: 75%;
            font-size: 0.95rem;
            white-space: pre-wrap;
            color: #202020;
            background-color: #d4af37;
            border-radius: 10px 10px 0 10px;
            padding: 12px 16px;
        }

        .chatbot__chat p.error {
            color: #721c24;
            background: #f8d7da;
        }

        .incoming p {
            color: #202020;
            background: #bdc3c7;
            border-radius: 10px 10px 10px 0;
        }

        .incoming span {
            width: 32px;
            height: 32px;
            line-height: 32px;
            color: #f3f7f8;
            background-color: #d4af37;
            border-radius: 4px;
            text-align: center;
            align-self: flex-end;
            margin: 0 10px 7px 0;
        }

        .outgoing {
            justify-content: flex-end;
            margin: 20px 0;
        }

        .incoming {
            margin: 20px 0;
        }

        .chatbot__input-box {
            position: absolute;
            bottom: 0;
            width: 100%;
            display: flex;
            gap: 5px;
            align-items: center;
            border-top: 1px solid #d4af37;
            background: #323232;
            padding: 5px 20px;
        }

        .chatbot__textarea {
            width: 100%;
            min-height: 55px;
            max-height: 180px;
            font-size: 0.95rem;
            padding: 16px 15px 16px 0;
            color: #202020;
            border: none;
            outline: none;
            resize: none;
            background: transparent;
        }

        .chatbot__textarea::placeholder {
            font-family: 'Poppins', sans-serif;
        }

        .chatbot__input-box span {
            font-size: 1.75rem;
            color: #d4af37;
            cursor: pointer;
            visibility: hidden;
        }

        .chatbot__textarea:valid~span {
            visibility: visible;
        }

        @media (max-width: 490px) {
            .chatbot {
                right: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                border-radius: 0;
            }

            .chatbot__box {
                height: 90%;
            }

            .chatbot__header span {
                display: inline;
            }
        }
    </style>

</head>

<body class="">


    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--********************************
   Code Start From Here
 ******************************** -->




    <!--==============================
    Mobile Menu
  ============================== -->
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e($setting->getFirstMediaUrl('header_logo')); ?>"
                        alt="tidal"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    
                    <li class="menu-item-has-children">
                        <a href="<?php echo e(url('projects')); ?>">Projects</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo e(url('home_for_sale')); ?>">Homes for Sale</a></li>
                            <li><a href="<?php echo e(url('home_for_rent')); ?>">Homes to Rent</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-item-has-children">
                        <a href="<?php echo e(url('contact')); ?>">Contact Us</a>
                    </li>
                    <?php if(Auth::check()): ?>
                        <li class="menu-item-has-children">
                            <a><i class="far fa-user"></i></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo e(url('wishlist')); ?>" class='users_class ps-0'><i
                                            class="far fa-heart"></i> Wishlist</a></li>
                                <li><a href="<?php echo e(route('logout')); ?>" class='users_class ps-0'
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out"></i> Logout</a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                        class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="menu-item-has-children">
                            <a href="<?php echo e(url('login')); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        </li>
                    <?php endif; ?>
                    <li class="menu-item-has-children">
                        <div class="widget widget-search border-0 p-0 container mt-2 mb-0">
                            <form id="search-form" class="search-form" action="<?php echo e(url('projects')); ?>" method="GET">
                                <input type="text" class="form-control" name="search" id="general_search"
                                    placeholder="Search an Address">
                                <button type=submit id="search_btn"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
 Header Area
==============================-->
    <header class="th-header header-layout4">
        <div class="header-top">
            <div class="th-container container">
                <div class="social-box">
                    <div class="th-social">
                        <!-- <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://skype.com/"><i class="fab fa-skype"></i></a>
                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <!-- Main Menu Area -->
                <div class="menu-area">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-3 col-4">
                                <div class="header-logo">
                                    <a href="<?php echo e(url('/')); ?>"><img
                                            src="<?php echo e($setting->getFirstMediaUrl('header_logo')); ?>" alt="tidal"></a>
                                </div>
                            </div>
                            <div class="col-md-9 col-8 d-flex justify-content-end">
                                <nav class="main-menu d-none d-lg-inline-block">
                                    <ul>
                                        
                                        <li class="menu-item-has-children">
                                            <a href="<?php echo e(url('projects')); ?>">Projects</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo e(url('home_for_sale')); ?>">Homes for Sale</a></li>
                                                <li><a href="<?php echo e(url('home_for_rent')); ?>">Homes to Rent</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="menu-item-has-children">
                                            <a href="<?php echo e(url('contact')); ?>">Contact Us</a>
                                        </li>
                                        <?php if(Auth::check()): ?>
                                            <li class="menu-item-has-children">
                                                <a><i class="far fa-user"></i></a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?php echo e(url('wishlist')); ?>" class='users_class ps-0'><i
                                                                class="far fa-heart"></i> Wishlist</a></li>
                                                    <li><a href="<?php echo e(route('logout')); ?>" class='users_class ps-0'
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                                class="fa fa-sign-out"></i> Logout</a>
                                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>"
                                                            method="POST" class="d-none">
                                                            <?php echo csrf_field(); ?>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li class="menu-item-has-children">
                                                <a href="<?php echo e(url('login')); ?>"><i class="fa fa-sign-in"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                        <?php endif; ?>
                                        <li class="menu-item-has-children">
                                            <div class="widget widget-search border-0 p-0 container mb-0">
                                                <form id="search-form" class="search-form"
                                                    action="<?php echo e(url('projects')); ?>" method="GET">
                                                    <input type="text" class="form-control" name="search"
                                                        id="general_search" placeholder="Search an Address">
                                                    <button type=submit id="search_btn"><i
                                                            class="far fa-search"></i></button>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                                <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i
                                        class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php echo $__env->yieldContent('content'); ?>


    <!--==============================
Footer Area
==============================-->
    <footer class="footer-wrapper footer-layout4">
        <div class="widget-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="widget footer-widget">
                            <div class="footer-logo">
                                <a href="<?php echo e(url('/')); ?>"><img
                                        src="<?php echo e($setting->getFirstMediaUrl('footer_logo')); ?>" alt="Gaia"
                                        class="img-fluid w-75"></a>
                            </div>
                            <div class="th-widget-about">
                                <p class="footer-text">Welcome to Gaia, your premier destination for real estate
                                    excellence. At Gaia, we redefine the real estate experience, offering a dynamic
                                    platform that seamlessly connects buyers, sellers, and renters with their ideal
                                    properties.</p>
                                <h6 class="text-theme mb-2">Social Network:</h6>
                                <div class="th-social">
                                    <?php if($setting->facebook): ?>
                                        <a target="_blank" href="<?php echo e($setting->facebook); ?>"><i
                                                class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>
                                    <?php if($setting->skype): ?>
                                        <a target="_blank" href="<?php echo e($setting->skype); ?>"><i
                                                class="fab fa-skype"></i></a>
                                    <?php endif; ?>
                                    <?php if($setting->twitter): ?>
                                        <a target="_blank" href="<?php echo e($setting->twitter); ?>"><i
                                                class="fab fa-twitter"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp d-flex justify-content-between" data-wow-delay="0.2s">
                        <div class="widget widget_nav_menu footer-widget style2">
                            <h3 class="widget_title">Quick Links</h3>
                            <div class="menu-all-pages-container">
                                <div class="list-two-column">
                                    <ul class="menu">
                                        <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                        <li><a href="<?php echo e(url('home_for_sale')); ?>">Home for Sale</a></li>
                                        <li><a href="<?php echo e(url('home_for_rent')); ?>">Home for Rent</a></li>
                                        <li><a href="<?php echo e(url('blog')); ?>">Blogs</a></li>
                                        <li><a href="<?php echo e(url('contact')); ?>">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="widget footer-widget style2">
                            <h3 class="widget_title">Contact Now</h3>
                            <div class="th-widget-contact">
                                <div class="info-box">
                                    <div class="info-box_icon">
                                        <i class="fal fa-location-dot"></i>
                                    </div>
                                    <div class="media-body">
                                        <span class="info-box_label">Office Address :</span>
                                        <p class="info-box_text" style="line-height: 25px;"><?php echo e($setting->address); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="info-box">
                                    <div class="info-box_icon">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                    <div class="media-body">
                                        <span class="info-box_label">Contact Number : </span>
                                        <a href="tel:+1<?php echo e($setting->phone); ?>" class="info-box_link">+(1)
                                            <?php echo e($setting->phone); ?></a>
                                    </div>
                                </div>
                                <div class="info-box">
                                    <div class="info-box_icon">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="media-body">
                                        <span class="info-box_label">Email Address :</span>
                                        <a href="mailto:<?php echo e($setting->email); ?>"
                                            class="info-box_link"><?php echo e($setting->email); ?></a>
                                    </div>
                                </div>
                                <div class="info-box">
                                    <div class="info-box_icon">
                                        <i class="fal fa-clock"></i>
                                    </div>
                                    <div class="media-body">
                                        <span class="info-box_label">Office Hours :</span>
                                        <a href="#" class="info-box_link"><?php echo e($setting->hours); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <p class="copyright-text text-center">Copyright By © <a href="<?php echo e(url('/')); ?>">Gaia</a> - 2023
                </p>
            </div>
        </div>
    </footer>




    <!--********************************
   Code End  Here
 ******************************** -->


    
     <?php if(Auth::user()): ?>
        <div class="chat-fix">
            <button class="chatbot__button">
                <span class="material-symbols-outlined"><i class="fa fa-comment"></i></span>
                <span class="material-symbols-outlined"><i class="fa fa-times"></i></span>
            </button>
            <div class="chatbot">
                <div class="chatbot__header">
                    <h3 class="chatbox__title">Chatbot</h3>
                    <span class="material-symbols-outlined">close</span>
                </div>
                <ul class="chatbot__box">
                    <li class="chatbot__chat incoming">
                        <span class="material-symbols-outlined"><i class="far fa-user"></i></span>
                        <p>Hi there. How can I help you today?</p>
                    </li>
                    <li class="chatbot__chat outgoing">
                        <p>...</p>
                    </li>

                </ul>
                <div class="chatbot__input-box">
                    <textarea class="chatbot__textarea" placeholder="Enter a message..." required></textarea>
                    <span id="send-btn" class="material-symbols-outlined"><i class="fa fa-location-arrow"
                            aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    <?php endif; ?> 




    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/slick.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/jquery.counterup.min.js"></script>
    <!-- Wow Animation -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/wow.min.js"></script>
    <!-- Main Js File -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/main.js"></script>
    <!-- Form Validation  -->
    <script src="<?php echo e(url('frontend')); ?>/assets/js/validation.js"></script>
    <!-- Sweet alert-->
    <script src="<?php echo e(route('/')); ?>/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script>
        var SweetAlert_custom = {
            init: function() {
                <?php if(session('success')): ?>
                    swal("Success", "<?php echo e(session('success')); ?>", "success")
                <?php endif; ?>

                <?php if(session('error')): ?>
                    swal("Error", "<?php echo e(session('error')); ?>", "error")
                <?php endif; ?>

            }
        };
        (function($) {
            SweetAlert_custom.init()
        })(jQuery);
    </script>

    <script>
        const chatbotToggle = document.querySelector('.chatbot__button');
        const sendChatBtn = document.querySelector('.chatbot__input-box span');
        const chatInput = document.querySelector('.chatbot__textarea');
        const chatBox = document.querySelector('.chatbot__box');
        const chatbotCloseBtn = document.querySelector('.chatbot__header span');

        let userMessage;
        // Need GPT key
        const inputInitHeight = chatInput.scrollHeight;
        const API_KEY = 'HERE';
        let contactMessageDisplayed = false; 

        const createChatLi = (message, className) => {
            const chatLi = document.createElement('li');
            chatLi.classList.add('chatbot__chat', className);
            let chatContent =
                className === 'outgoing' ?
                `<p></p>` :
                `<span class="material-symbols-outlined"><i class="far fa-user"></i></span> <p></p>`;
            chatLi.innerHTML = chatContent;
            chatLi.querySelector('p').textContent = message;
            return chatLi;
        };


        // const generateResponse = (incomingChatLi) => {
        //     const messageElement = incomingChatLi.querySelector('p');
            
        //     if (!contactMessageDisplayed) {
        //         messageElement.textContent = 'Contact As Soon As Possible...';
        //         contactMessageDisplayed = true;
        //     } else {
        //         messageElement.textContent = '';
        //     }
        // };

        const handleChat = () => {
            userMessage = chatInput.value.trim();
            if (!userMessage) return;
            chatInput.value = '';
            chatInput.style.height = `${inputInitHeight}px`;

            chatBox.appendChild(createChatLi(userMessage, 'outgoing'));
            chatBox.scrollTo(0, chatBox.scrollHeight);

            // AJAX request to store the chat message
            fetch('/store-chat-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', // Ensure to include CSRF token if using Laravel CSRF protection
                },
                body: JSON.stringify({ message: userMessage }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Message stored:', data);
            })
            .catch(error => {   
                console.error('Error storing message:', error);
            });

            // setTimeout(() => {
            //     const incomingChatLi = createChatLi('Thinking...', 'incoming');
            //     chatBox.appendChild(incomingChatLi);
            //     chatBox.scrollTo(0, chatBox.scrollHeight);
            //     generateResponse(incomingChatLi);
            // }, 600);
        };

        chatInput.addEventListener('input', () => {
            chatInput.style.height = `${inputInitHeight}px`;
            chatInput.style.height = `${chatInput.scrollHeight}px`;
        });
        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey && window.innerWidth > 800) {
                e.preventDefault();
                handleChat();
            }
        });
        chatbotToggle.addEventListener('click', () =>
            document.body.classList.toggle('show-chatbot')
        );
        chatbotCloseBtn.addEventListener('click', () =>
            document.body.classList.remove('show-chatbot')
        );
        sendChatBtn.addEventListener('click', handleChat);
    </script>

<script>
    $(document).ready(function() {
        // Fetch chats when the page loads
        const fetchChats = async () => {
            try {
                const response = await $.ajax({
                    url: "<?php echo e(route('fetch.chats')); ?>",
                    type: "GET"
                });
                updateChatsUI(response);
            } catch (error) {
                console.error(error.responseText);
            }
        };

        // Call fetchChats function immediately
        fetchChats();

        function refreshChats() {
            setInterval(function() {
                fetchChats();
            }, 2000); // Refresh every 2 seconds (2000 milliseconds)
        }

        // Call the refreshChats() function to start refreshing the chats
        refreshChats();
        function updateChatsUI(chats) { 
            // Clear the existing chat box content
            $('.chatbot__box').empty();
            $('.chatbot__box').append('<li class="chatbot__chat incoming"><span class="material-symbols-outlined"><i class="far fa-user"></i></span><p>Welcome to the chat! How can I assist you?</p></li>');
            // Iterate through the fetched chats and append them to the chat box
            $.each(chats, function(index, chat) {
                var chatHtml = '';
                if (chat.to_user === null) {
                    chatHtml += '<li class="chatbot__chat outgoing">';
                } else {
                    chatHtml += '<li class="chatbot__chat incoming">';
                    chatHtml += '<span class="material-symbols-outlined"><i class="far fa-user"></i></span>';
                }
                chatHtml += '<p>' + chat.massage + '</p>';
                chatHtml += '</li>';
                $('.chatbot__box').append(chatHtml);
            });
        }
    });
</script>
</body>

</html>
<?php /**PATH F:\raj\gaia\resources\views/frontend/layout/app.blade.php ENDPATH**/ ?>