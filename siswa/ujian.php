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
        $menu = "index";
        require 'menu.php';
       ?>

      <div class="main-panel">
         <?php require 'header.php'; ?>
        <div class="container">
          <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Ujian</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                </div>
            </div>
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
                              <label for="soal1_jawaban4">6</label>
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
                              <label for="soal2_jawaban1">Jakarta</label><br>
                              <input type="radio" id="soal2_jawaban2" name="soal2" value="Surabaya" onclick="checkAnswer(2, 'Surabaya', 'Jakarta')">
                              <label for="soal2_jawaban2">Surabaya</label><br>
                              <input type="radio" id="soal2_jawaban3" name="soal2" value="Bandung" onclick="checkAnswer(2, 'Bandung', 'Jakarta')">
                              <label for="soal2_jawaban3">Bandung</label><br>
                              <input type="radio" id="soal2_jawaban4" name="soal2" value="Medan" onclick="checkAnswer(2, 'Medan', 'Jakarta')">
                              <label for="soal2_jawaban4">Medan</label>
                          </div>
                          <p id="feedback2" class="feedback"></p>
                      </div>
                      <div class="question-buttons"></div>
                  </div>
              </div>

              <div id="question3" class="question-container">
                  <div class="d-flex">
                      <div class="flex-grow-1">
                          <h5 class="fw-bold">3. Planet terdekat dengan matahari adalah?</h5>
                          <div>
                              <input type="radio" id="soal3_jawaban1" name="soal3" value="Bumi" onclick="checkAnswer(3, 'Bumi', 'Merkurius')">
                              <label for="soal3_jawaban1">Bumi</label><br>
                              <input type="radio" id="soal3_jawaban2" name="soal3" value="Merkurius" onclick="checkAnswer(3, 'Merkurius', 'Merkurius')">
                              <label for="soal3_jawaban2">Merkurius</label><br>
                              <input type="radio" id="soal3_jawaban3" name="soal3" value="Mars" onclick="checkAnswer(3, 'Mars', 'Merkurius')">
                              <label for="soal3_jawaban3">Mars</label><br>
                              <input type="radio" id="soal3_jawaban4" name="soal3" value="Venus" onclick="checkAnswer(3, 'Venus', 'Merkurius')">
                              <label for="soal3_jawaban4">Venus</label>
                          </div>
                          <p id="feedback3" class="feedback"></p>
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
        let answeredQuestions = {};
        const totalQuestions = 40;

        document.addEventListener('DOMContentLoaded', function() {
            generateButtons(totalQuestions);
        });

        function generateButtons(total) {
            const buttonContainers = document.querySelectorAll('.question-buttons');

            buttonContainers.forEach(container => {
                container.innerHTML = '';

                for (let i = 1; i <= total; i++) {
                    const button = document.createElement('button');
                    button.className = 'btn btn-primary';
                    button.dataset.question = i;
                    button.textContent = i;
                    button.onclick = function() {
                        showQuestion(i);
                    };
                    container.appendChild(button);
                    if (i % 4 === 0) {
                container.appendChild(document.createElement('br'));
            }
                }
            });
        }

        function checkAnswer(questionNumber, selectedAnswer, correctAnswer) {
            const feedbackElement = document.getElementById(`feedback${questionNumber}`);
            const buttons = document.querySelectorAll(`.question-buttons button[data-question="${questionNumber}"]`);

            buttons.forEach(button => {
                button.classList.remove('btn-primary', 'btn-success', 'btn-danger');
            });

            if (selectedAnswer === correctAnswer) {
                feedbackElement.textContent = "Jawaban benar!";
                feedbackElement.style.color = "green";
                
                buttons.forEach(button => {
                    button.classList.add('btn-success');
                    button.disabled = true;
                });

            } else {
                feedbackElement.textContent = "Jawaban salah. Coba lagi!";
                feedbackElement.style.color = "red";
                
                buttons.forEach(button => {
                    button.classList.add('btn-danger');
                    button.disabled = true;
                });
            }

            answeredQuestions[questionNumber] = true;
            checkAllAnswered();
        }

        function showQuestion(questionNumber) {
            const questions = document.querySelectorAll('.question-container');
            questions.forEach(question => question.classList.remove('active'));
            document.getElementById(`question${questionNumber}`).classList.add('active');
            
            if (answeredQuestions[questionNumber]) {
                document.querySelectorAll(`.question-buttons button[data-question="${questionNumber}"]`).forEach(button => {
                    button.classList.remove('btn-primary');
                    button.classList.add(answeredQuestions[questionNumber] === true ? 'btn-success' : 'btn-danger');
                    button.disabled = true;
                });
            }
        }

        function checkAllAnswered() {
            if (Object.keys(answeredQuestions).length === totalQuestions) {
                document.getElementById('finish-button').style.display = 'block';
            }
        }

        function finishQuiz() {
            const confirmFinish = confirm("Apakah Anda yakin semua jawaban sudah benar? Klik 'OK' untuk menyelesaikan kuis atau 'Cancel' untuk kembali memeriksa jawaban Anda.");
            
            if (confirmFinish) {
                alert("Anda telah menyelesaikan kuis!");
            }
        }

    </script>
  </body>
</html>
