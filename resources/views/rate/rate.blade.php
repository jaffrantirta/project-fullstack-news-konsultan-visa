<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="res/assets_rate/fonts/icomoon/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="res/assets_rate/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="res/assets_rate/css/style.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Rate Us!</title>

    <style>
      @font-face {
        font-family: myFirstFont;
        src: url(rate_assets/fonts/icomoon/fonts/icomoon.woff);
      }
      * {
        font-family: myFirstFont;
      }
      .rating {
          display: flex;
          flex-direction: row-reverse;
          justify-content: center
      }

      .rating>input {
          display: none
      }

      .rating>label {
          position: relative;
          width: 1em;
          font-size: 6vw;
          color: #FFD600;
          cursor: pointer
      }

      .rating>label::before {
          content: "\2605";
          position: absolute;
          opacity: 0
      }

      .rating>label:hover:before,
      .rating>label:hover~label:before {
          opacity: 1 !important
      }

      .rating>input:checked~label:before {
          opacity: 1
      }

      .rating:hover>input:checked~label:before {
          opacity: 0.4
      }

      body {
          /* background: #222225; */
          /* color: white */
      }

      h1,
      p {
          text-align: center
      }

      h1 {
          margin-top: 150px
      }

      p {
          font-size: 1.2rem
      }

      @media only screen and (max-width: 600px) {
          h1 {
              font-size: 14px
          }

          p {
              font-size: 12px
          }
      }
    </style>
  </head>
  <body>
    <p hidden id='uuid'>{{$data['place']->uuid}}</p>
    <div class="container content">
      <div class="row justify-content-center">
        <img src="res/assets_rate/images/rate.png" alt="Image" class="img-fluid">
      </div>
      <div class=" m-1 row justify-content-center">
        <h3>{{$data['place']->name}}</h3><br>
        <p class="text-center h5">Yuk kasi masukan untuk kebersihan kami! kami selalu meningkatkan kebersihan dan kenyamanan pelanggan. Masukan dan saran anda sangat membantu.</p>
      </div>
      <div class="m-4 row align-items-center">
        <div class="col-12 text-center">
            <button style="border-radius: 2em; background-color: #9dc9d2" onclick="start()" id="btn_start" type="button" class="btn px-4 py-3" data-toggle="modal" data-target="#q1">
                Beri Penilaian!
            </button>
            <div hidden id="rate">
              <h4 class="text-center">Beri Penilain Bintang!</h4>
              <div class="rating"><input onclick="starSelect(5)" type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input onclick="starSelect(4)" type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input onclick="starSelect(3)" type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input onclick="starSelect(2)" type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input onclick="starSelect(1)" type="radio" name="rating" value="1" id="1"><label for="1">☆</label><br><br></div>
              <textarea style="border: 1px solid #9dc9d2; box-shadow: 0 0 0 0.2rem rgba(157,201,210,255);" id="comment" class="form-control" cols="2" rows="3" placeholder="Berikan komentar (opsional)"></textarea><br><br>
              <button style="border-radius: 2em; background-color: #9dc9d2" onclick="sendFeedBack()" type="button" class="btn px-4 py-3">
                Kirim
              </button>
            </div>
        </div>
      </div>
      <footer class="footer">
        <hr>
        <blockquote class="blockquote text-center">
          <p class="mb-0">Kebersihan adalah kunci kenyamanan</p>
          <strong style="font-size: 15px"> {{$data['settings']['system_name']}} &copy; 2022</strong>
          <p>{{$data['settings']['corporate_name']}}</p>
        </blockquote>
      </footer>
    </div>

    <!-- Modal -->
    @foreach($data['questions'] as $q)
    <div class="modal hide fade" data-keyboard="false" data-backdrop="static" id="q{{$q->sort}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-body py-0">
            <div class="d-block main-content">
              <img src="res/assets_rate/images/question.png" alt="Image" class="img-fluid" style="background-color: #b2fcff;">
              <div class="content-text p-4">
                <h3 class="mb-4">{{$q->question}}</h3>
                <div class="d-flex">
                  <div class="ml-auto">
                      @foreach ($q->answer as $a)
                        <a href="#" onclick="setSession({{$q->id}}, {{$a->id}}, {{$data['place']->id}})" data-toggle="modal" data-target="#q{{$q->sort+1}}" class="btn btn-link" data-dismiss="modal">{{$a->answer}}</a>
                      @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach

    <script>
      $(function() {
        var uuid = $('#uuid').html();
        var cuuid = getCookie(uuid);
        if(uuid == cuuid){
          console.log('anda hanya bisa memberi review 1/tempat/hari');
          Swal.fire({
            icon: 'warning',
            text: 'Oops! Sepertinya anda sudah memberi penilaian ditempat ini. Anda hanya bisa memberi review 1/tempat/hari.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false
          })
        }else{
          console.log('belum pernah memberi review');
        }
      });

      function getCookie(cname) {
          var name = cname + "=";
          var decodedCookie = decodeURIComponent(document.cookie);
          var ca = decodedCookie.split(';');
          for(var i = 0; i <ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0) == ' ') {
                  c = c.substring(1);
              }
              if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
              }
          }
          return "";
      }

      var feedback = new Array();

      function setSession(q_id, a_id, p_id){
        feedback.push('{"question_id":'+q_id+',"answer_id":'+a_id+',"place_id":'+p_id+'}');
        sessionStorage.setItem('feedback', feedback);
      }

      function showSession(){
        var feedback = '{"feedback":['+sessionStorage.getItem('feedback')+']}';
        var star = sessionStorage.getItem('star');
        var comment = $('textarea#comment').val();
        console.log(feedback+" --- "+star+" --- "+comment);
      }

      function start(){
        $('#btn_start').hide();
        $('#rate').attr('hidden', false);
      }

      function starSelect(rate){
        sessionStorage.setItem('star', rate);
      }

      function sendFeedBack(){
        Swal.fire({
          title: 'Mengirim penilaian',
          allowOutsideClick: false,
          allowEscapeKey: false,
          showConfirmButton: false
        })
        var feedback = '{"feedback":['+sessionStorage.getItem('feedback')+']}';
        var star = sessionStorage.getItem('star');
        var comment = $('textarea#comment').val();
        $.ajax({
          url:'api/rate/add',
          type: 'post',
          data: {'feedback':feedback, 'star':star, 'comment':comment},
          success: function(result){
            var uuid = $('#uuid').html();
            // console.log(uuid);
            setCookie(uuid, uuid, 1);
            Swal.fire({
              icon: 'success',
              title: result.message
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'https://istana.jagoanqr.com';
              }
            })
          },
          error: function(error, x, y){
            // console.log(error);
            var err = JSON.parse(error.responseText);
            Swal.fire({
              icon: 'error',
              title: err.message
            })
          }
        });
      }

      function setCookie(cname, cvalue, exdays) {
          var d = new Date();
          d.setTime(d.getTime() + (exdays*24*60*60*1000));
          var expires = "expires="+ d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
    </script>

    
    <script src="res/assets_rate/js/jquery-3.3.1.min.js"></script>
    <script src="res/assets_rate/js/popper.min.js"></script>
    <script src="res/assets_rate/js/bootstrap.min.js"></script>
    <script src="res/assets_rate/js/main.js"></script>
  </body>
</html>