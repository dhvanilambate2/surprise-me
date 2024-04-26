@extends('layouts.simple.master')
@section('title', 'Chat Details')

@section('css')
@endsection

@section('style')
    <style>
        .truncate-text {
            max-width: 150px;
            /* Adjust the maximum width according to your design */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-item {
            width: 33%;
            text-align: center;
        }
        .welcome-message{
            color: #7e37d8;
            padding: 20px;
            line-height: 1.9;
            letter-spacing: 1px;
            font-size: 30px;
            width: 100%;
            position: relative;
            height: 33vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .clearfix{
            cursor: pointer;
        }
        
    </style>
@endsection

@section('breadcrumb-title')
    <h2>Chat<span>Details</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Chat</li>
    <li class="breadcrumb-item active">Chat Details</li>
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col call-chat-sidebar col-sm-12">
                <div class="card">
                    <div class="card-body chat-body">
                        <div class="chat-box">
                            <!-- Chat left side Start-->
                            <div class="chat-left-aside">
                                {{-- <div class="d-flex">
                                    <img class="rounded-circle user-image"
                                        src="https://laravel.pixelstrap.com/poco/assets/images/user/12.png" alt="">
                                    <div class="about">
                                        <div class="name f-w-600">Mark Jecno</div>
                                        <div class="status">Status...</div>
                                    </div>
                                </div> --}}
                                <div class="people-list" id="people-list">
                                    <h6 class="m-3" style="color: #7e37d8;">Recent Chats</h6>
                                    <hr>
                                    {{-- <div class="search">
                                        <form class="theme-form">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="search"><i
                                                    class="fa fa-search"></i>
                                            </div>
                                        </form>
                                    </div> --}}
                                    <ul class="list">
                                      
                                    </ul>

                                </div>
                            </div>
                            <!-- Chat left side Ends-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pe-0 chat-right-aside">
                                <!-- chat start-->
                                <div class="chat">
                                    <!-- chat-header start-->
                                    <div class="chat-header clearfix d-flex align-items-center">
                                        <img class="rounded-circle"
                                            src="https://laravel.pixelstrap.com/poco/assets/images/user/8.jpg"
                                            alt="">
                                        <div class="about">
                                            <div class="name">Chat With User </div>
                                        </div> 
                                    </div>
                                    <!-- chat-header end-->
                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                        <ul id="user-chats">
                                            <li>
                                                <div class="welcome-message">
                                                    Welcome to the chat!
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end chat-history-->
                                    <div class="chat-message clearfix" style="display: none;">
                                        <div class="row">
                                            <div class="col-xl-12 d-flex">
                                                <input class="form-control input-txt-bx" id="user_id"
                                                        type="hidden" name="user_id"
                                                        placeholder="Type a message......">
                                                <div class="input-group text-box">
                                                    <input class="form-control input-txt-bx" id="message-to-send"
                                                        type="text" name="message-to-send"
                                                        placeholder="Type a message......">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="chat-submit" type="button">SEND</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end chat-message-->
                                    <!-- chat end-->
                                    <!-- Chat right side ends-->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="welcome-popup modal fade" id="loadModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="modal-header"></div>
                    <div class="contain p-30">
                        <div class="text-center">
                            <h3>Welcome to creative admin</h3>
                            <p>start your project with developer friendly admin </p>
                            <button class="btn btn-primary btn-lg txt-white" type="button" data-bs-dismiss="modal"
                                aria-label="Close">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function loadData(tab) {
            currentTab = tab;
            // Make an Ajax call to fetch data based on the selected tab
            $.ajax({
                url: '{{ route('get_inquire_details') }}',
                method: 'GET',
                data: {
                    tab: tab
                }, // Pass the selected tab as a parameter
                success: function(response) {
                    // Handle the success response and update the corresponding table
                    switch (tab) {
                        case 'sale':
                            $('#sale-table').html(response.tableContent);
                            break;
                        case 'rent':
                            $('#rent-table').html(response.tableContent);
                            break;
                        case 'contact':
                            $('#contact-table').html(response.tableContent);
                            break;
                        default:
                            break;
                    }
                },
                error: function(error) {
                    // Handle the error if needed
                    console.error(error);
                }
            });
        }

        // Initial load for the 'Sale' tab
        loadData('sale');
    </script>
    <script>
        function updateChatsUI(chats) {
                // Clear the existing chat box content
                var userChats = $('#user-chats');
                $('#user-chats').empty();
                var userId = $('#user_id').val();

                if (!userId) 
                {
                    $('.chat-message').css('display', 'none');
                    var chatHtml = '<li><div class="welcome-message">Welcome to the chat!</div></li>';
                    $('#user-chats').append(chatHtml);
                }
                else
                {
                    $('.chat-message').css('display', 'block');
                    $('#chat_count'+userId).hide();
                    $.each(chats, function(index, chat) {
                        var chatHtml = '';
                        if (chat.to_user === null) {
                            chatHtml += '<li class="clearfix">';
                            chatHtml += '<div class="message other-message pull-right">'+ chat.massage +'</div>';
                        } else {
                            chatHtml += '<li>';
                            chatHtml += '<div class="message my-message">'+ chat.massage +'</div>';
                        }
                        chatHtml += '</li>';
                        $('#user-chats').append(chatHtml);
                    });
                }
                var chatHistory = $('.chat-history');
                chatHistory.scrollTop(chatHistory[0].scrollHeight);

            }
        // Define fetchChats globally
        const fetchChats = async () => {
            // try {
                const response = await $.ajax({
                    url: "{{ route('fetch.admin.chats') }}",
                    type: "GET",
                    data: {
                        user_id: $('#user_id').val()
                    }
                });
                updateChatsUI(response);
                // Inside your script section
                $.ajax({
                    url: '{{ route("fetch.chat.users") }}',
                    type: 'GET',
                    success: function(response) {
                        // Handle success response
                        userListFunction(response);
                       
                        // Update your UI with the fetched users data
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error fetching users:', error);
                    }
                });

           
        };
    
        function userListFunction(response) {
            var userList = $('#people-list .list');
            userList.empty(); 

            if (response.length === 0) {
                userList.append('<li class="text-center">No chats available</li>');
            } else {
                $.each(response, function(index, user) {
                    var userHtml = '<li class="clearfix d-flex align-items-center">' + 
                                        '<img class="rounded-circle user-image" src="https://laravel.pixelstrap.com/poco/assets/images/user/1.jpg" alt="">' +
                                        '<div class="status-circle online text-light text-center ' + (user.unread_chat_count > 0 ? '' : 'd-none') + '" id="chat_count' + user.full_user.id + '" style="width: 23px; height: 23px;">' + user.unread_chat_count + '</div>' +
                                        '<div class="about pl-3">' +
                                            '<div class="name">' + user.full_user.name + '</div>' +
                                            '<div class="userid d-none">' + user.full_user.id + '</div>' +
                                        '</div>' +
                                    '</li>';
                    userList.append(userHtml);
                });
            }
        }

        $(document).ready(function() {
            // Attach click event listener to each user element in the sidebar
            $(document).on('click', '.list .clearfix', function() {
                // Get the name of the user clicked
                var userName = $(this).find('.name').text().trim();
                var userId = $(this).find('.userid').text().trim();
                console.log(userId);
                // Update the chat header with the clicked user's name
                $('.chat-header .name').text(userName);
                $('#user_id').val(userId);

                // Optionally, you can load chat history for this user or switch to an existing chat if applicable
                // For simplicity, let's just clear the chat history in this example
                $('.chat-history ul').empty();

                // Now you can call fetchChats
                fetchChats();
                changeStatus(userId);
            });
    
            $('#chat-submit').click(function() {
                var message = $('#message-to-send').val();
                var id = $('#user_id').val();
    
                // Send the AJAX request
                $.ajax({
                    url: '{{ route("chat.store") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        message: message,
                        id: id,
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Optionally, clear the input field after successful message sending
                        $('#message-to-send').val('');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });
    
            // Call fetchChats function immediately
            fetchChats();
    
            function refreshChats() {
                setInterval(function() {
                    fetchChats();
                }, 2000); // Refresh every 2 seconds (2000 milliseconds)
            }
    
            // Call the refreshChats() function to start refreshing the chats
            refreshChats();
    
            function changeStatus(userId) {
                $.ajax({
                    url: '{{ route("update.chat.status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    success: function(response) {
                        // Handle success response if needed
                        // console.log('Status updated successfully');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response if needed
                        console.error('Error updating status:', error);
                    }
                });
            }
           
        });
        
    </script>
    
@endsection
