<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>E-Learning</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/sekolah/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <style>
        .question-container {
            display: none;
        }
        .question-container.active {
            display: block;
        }
        .question-buttons button {
            width: 60px;
            height: 40px;
            margin: 5px;
            text-align: center;
        }

        .question-buttons {
            margin-top: 0;
            text-align: right;
            align-self: flex-start;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-success:disabled, .btn-danger:disabled {
            cursor: not-allowed;
        }
        #finish-button {
            display: none;
            margin-top: 20px;
            text-align: center;
        }
    </style>
  </head>
  <body>
    <?php require '../config.php'; ?>
    <div class="wrapper">
       <?php
        $menu = "Quiz";
        require 'menu.php';
       ?>

      <div class="main-panel">
         <?php require 'header.php'; ?>
        <div class="container">
          <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Kuis</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                </div>
            </div>
            <?php
            if(isset($_POST['mulai']) && isset($_GET['id'])){
                $id_kuis = $_GET['id'];
                $_SESSION['jawab'] = ['id' => $id_kuis, 'jawab' => []];
            }else if(isset($_SESSION['jawab']) && !isset($_GET['id']) || $_GET['id'] == null){
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.url("/siswa/kuisdtl.php?id=".$_SESSION['jawab']['id']).'";';
                echo '</script>';
            }
            $jawab = $_SESSION['jawab'];
            ?>
            <div class="row">
                <div id="question1" class="question-container active">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h5 class="fw-bold">1. Berapakah hasil dari 2 + 2?</h5>
                            <div>
                                <input type="radio" id="soal1_jawaban1" name="soal1" value="3" onclick="checkAnswer(1, '3', '4')">
                                <label for="soal1_jawaban1">3</label><br>
                                <input type="radio" id="soal1_jawaban2" name="soal1" value="4" onclick="checkAnswer(1, '4', '4')">
                                <label for="soal1_jawaban2">4</label><br>
                                <input type="radio" id="soal1_jawaban3" name="soal1" value="5" onclick="checkAnswer(1, '5', '4')">
                                <label for="soal1_jawaban3">5</label><br>
                                <input type="radio" id="soal1_jawaban4" name="soal1" value="6" onclick="checkAnswer(1, '6', '4')">
                                <label>6</label>
                            </div>
                            <p id="feedback1" class="feedback"></p>
                        </div>
                        <div class="question-buttons"></div>
                    </div>
                </div>
              <div id="question2" class="question-container">
                  <div class="d-flex">
                      <div class="flex-grow-1">
                          <h5 class="fw-bold">2. Ibukota Indonesia adalah?</h5>
                          <div>
                              <input type="radio" id="soal2_jawaban1" name="soal2" value="Jakarta" onclick="checkAnswer(2, 'Jakarta', 'Jakarta')">
                              <label>Jakarta</label><br>
                              <input type="radio" id="soal2_jawaban2" name="soal2" value="Surabaya" onclick="checkAnswer(2, 'Surabaya', 'Jakarta')">
                              <label>Surabaya</label><br>
                              <input type="radio" id="soal2_jawaban3" name="soal2" value="Bandung" onclick="checkAnswer(2, 'Bandung', 'Jakarta')">
                              <label>Bandung</label><br>
                              <input type="radio" id="soal2_jawaban4" name="soal2" value="Medan" onclick="checkAnswer(2, 'Medan', 'Jakarta')">
                              <label>Medan</label>
                          </div>
                          <p id="feedback2" class="feedback"></p>
                      </div>
                      <div class="question-buttons"></div>
                  </div>
              </div>
          </div>
          <div id="finish-button">
              <button class="btn btn-primary" onclick="finishQuiz()">Selesai</button>
          </div>

          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/js/main.min.js"></script>

    <script>
        // seesion php
        let answeredQuestions = <?= json_encode($jawab['jawab']) ?>;
        const totalQuestions = 2;

        $(document).ready(function() {
            generateButtons(totalQuestions);
        });

        function generateButtons(total) {
            $('.question-buttons').each(function() {
                $(this).empty();

                for (let i = 1; i <= total; i++) {
                    const $button = $('<button>')
                        .addClass('btn btn-primary')
                        .attr('data-question', i)
                        .text(i)
                        .on('click', function() {
                            showQuestion(i);
                        });

                    $(this).append($button);

                    if (i % 3 === 0) {
                        $(this).append('<br>');
                    }
                }
            });
        }

        function checkAnswer(questionNumber, selectedAnswer, correctAnswer) {
            const $feedbackElement = $(`#feedback${questionNumber}`);
            const $buttons = $(`.question-buttons button[data-question="${questionNumber}"]`);

            $buttons.removeClass('btn-primary btn-success btn-danger');

            if (selectedAnswer === correctAnswer) {
                $feedbackElement.text("Jawaban benar!").css('color', 'green');

                $buttons.addClass('btn-success').prop('disabled', true);
            } else {
                $feedbackElement.text("Jawaban salah. Coba lagi!").css('color', 'red');

                $buttons.addClass('btn-danger').prop('disabled', true);
            }

            answeredQuestions[questionNumber] = true;
            console.log(answeredQuestions);
            checkAllAnswered();
        }

        function showQuestion(questionNumber) {
            $('.question-container').removeClass('active');
            $(`#question${questionNumber}`).addClass('active');

            if (answeredQuestions[questionNumber]) {
                $(`.question-buttons button[data-question="${questionNumber}"]`).each(function() {
                    $(this).removeClass('btn-primary');
                    $(this).addClass(answeredQuestions[questionNumber] === true ? 'btn-success' : 'btn-danger');
                    $(this).prop('disabled', true);
                });
            }
        }
        function checkAllAnswered() {
            if (Object.keys(answeredQuestions).length === totalQuestions) {
                $('#finish-button').show();
            }
        }

        function finishQuiz() {
            const confirmFinish = confirm("Apakah Anda yakin semua jawaban sudah benar? Klik 'OK' untuk menyelesaikan kuis atau 'Cancel' untuk kembali memeriksa jawaban Anda.");

            if (confirmFinish) {
                window.location.href = 'kuisselesai.php';
            }
        }


    </script>
  </body>
</html>
