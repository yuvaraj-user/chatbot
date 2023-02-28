<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatbot</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" integrity="sha512-PIAUVU8u1vAd0Sz1sS1bFE5F1YjGqm/scQJ+VIUJL9kNa8jtAWFUDMu5vynXPDprRRBqHrE8KKEsjA7z22J1FA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha512-lzilC+JFd6YV8+vQRNRtU7DOqv5Sa9Ek53lXt/k91HZTJpytHS1L6l1mMKR9K6VVoDt4LiEXaa6XBrYk1YhGTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <?php date_default_timezone_set('Asia/Kolkata'); ?>
    <div class="bot-container">
        <input type="hidden" name="token" value="{{csrf_token()}}" id="csrf_token">
        <div class="bot-head">
            <div class="head-title">
                <h3>Chatbot</h3>
            </div>
            <div class="bot-close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </div>
        <div class="bot-message">
            <div class="message">
                    <p>Hi I'm chatbot</p>                    
                    <small class="time">{{date('h:i A')}}</small>
            </div>
            <div class="top-scroll">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </div>
        </div>
        <div class="bot-footer">
            <input type="text" name="message" placeholder="Type message" id="message-textbox">
            <button class="send-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/3682/3682321.png" class="send-img">
            </button>
        </div>
    </div>
    <div class="message-icon-btn">
        <i class="fa fa-envelope" aria-hidden="true"></i>
    </div>
    <!-- <button class="top-scroll">top</button> -->

</body>
<!-- <div style="height:100px;background-color:blue;width:200px;overflow-y:scroll;">
    <p>dfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfddfdgfdfd</p>
</div> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> -->
<script>
    var botmanWidget = {
        aboutText: 'google',
        introMessage: "✋ &#128516; Hi! I'm laravel application"
    };
</script>

<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
<script>
    // var element = document.getElementsByClassName('desktop-closed-message-avatar');
    // console.log(element);
    // element.addEventListener('click',function(){
    //     var text = document.getElementById("botmanWidgetRoot");
    // console.log(text);
    // });
    // document.on('.desktop-closed-message-avatar','click',function(){
    //     console.log(this);
    // });
    // var date = new Date();
    // date.getHours();
    // date.getMinutes();
    // var curr_time = new Date().toLocaleTimeString(); 
 
    var base_url = "{{ url('/') }}";
    var token = $('#csrf_token').val();
    $('.top-scroll').hide();
    var curr_time = "<?php echo(date('h:i A'));?>";
    console.log(curr_time);
    $(document).on('click', '.message-icon-btn', function() {
        $('.bot-container').show();
        $('.message-icon-btn').hide();
    });
    $(document).on('click', '.bot-close', function() {
        $('.bot-container').hide();
        $('.message-icon-btn').show();
    });
    $(document).on('keyup', '#message-textbox', function(e) {
        let message = $(this).val();
        if (e.key == 'Enter') {
            user_msg_temp = "<div class=reply><p>" + message + "</p><small class=time>"+curr_time+"</small></div>";
            $('.top-scroll').before(user_msg_temp);
            $('#message-textbox').val('');
            message_send(message);
        }
    });

    $(document).on('click', '.send-btn', function() {
        let message = $('#message-textbox').val();
        if (message != '') {
            user_msg_temp = "<div class=reply><p>" + message + "</p><small class=time>"+curr_time+"</small></div>";
            $('.top-scroll').before(user_msg_temp);
            $('#message-textbox').val('');
            message_send(message);
        }
    });

    function message_send(msg) {
        console.log(base_url);
        $.ajax({
            url: base_url + '/send_message',
            type: "POST",
            data: {
                _token: token,
                message: msg
            },
            success: function(res) {
                // console.log(res.reply);
                if (res.reply) {
                    reply_temp = "<div class=message><p>" + res.reply + "</p><small class=time>"+curr_time+"</small></div>";
                    $('.top-scroll').before(reply_temp);
                }
                if (res.bot_question) {
                    question_temp = "<div class=message><p>" + res.bot_question + "</p><small class=time>"+curr_time+"</small></div>";
                    $('.top-scroll').before(question_temp);
                }
                autoscroll();
                uparrow_check()
            }
        });
    }

    function autoscroll() {
        $(".bot-message").animate({
            scrollTop: $('.bot-message')[0].scrollHeight
        }, 1000, 'linear');
    }

    function uparrow_check() {
        $original_height = $('.bot-message').height();
        $content_height = $('.bot-message')[0].scrollHeight;
        if ($original_height < $content_height) {
            $('.top-scroll').show();
        }
    }
    $(document).on('click', ".top-scroll", function() {
        $('.bot-message').animate({
            scrollTop: 0
        });
    });
</script>

</html>