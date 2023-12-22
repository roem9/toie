function ielts_listening(benar, date) {
  if (date < "2023-10-20") {
    if (benar >= 39 && benar <= 40) {
      return 9;
    } else if (benar >= 37 && benar <= 38) {
      return 8.5;
    } else if (benar >= 35 && benar <= 36) {
      return 8;
    } else if (benar >= 32 && benar <= 34) {
      return 7.5;
    } else if (benar >= 30 && benar <= 31) {
      return 7;
    } else if (benar >= 26 && benar <= 29) {
      return 6.5;
    } else if (benar >= 23 && benar <= 25) {
      return 6;
    } else if (benar >= 18 && benar <= 22) {
      return 5.5;
    } else if (benar >= 16 && benar <= 17) {
      return 5;
    } else if (benar >= 13 && benar <= 15) {
      return 4.5;
    } else if (benar >= 11 && benar <= 12) {
      return 4;
    } else if (benar >= 8 && benar <= 10) {
      return 3.5;
    } else if (benar >= 6 && benar <= 7) {
      return 3;
    } else if (benar >= 4 && benar <= 5) {
      return 2.5;
    } else {
      return 0;
    }
  } else {
    if (benar >= 39 && benar <= 40) {
      return 9;
    } else if (benar >= 37 && benar <= 38) {
      return 8.5;
    } else if (benar >= 35 && benar <= 36) {
      return 8;
    } else if (benar >= 32 && benar <= 34) {
      return 7.5;
    } else if (benar >= 30 && benar <= 31) {
      return 7;
    } else if (benar >= 26 && benar <= 29) {
      return 6.5;
    } else if (benar >= 23 && benar <= 25) {
      return 6;
    } else if (benar >= 18 && benar <= 22) {
      return 5.5;
    } else if (benar >= 16 && benar <= 17) {
      return 5;
    } else if (benar >= 13 && benar <= 15) {
      return 4.5;
    } else if (benar >= 11 && benar <= 12) {
      return 4;
    } else if (benar >= 8 && benar <= 10) {
      return 3.5;
    } else if (benar >= 6 && benar <= 7) {
      return 3;
    } else if (benar >= 4 && benar <= 5) {
      return 2.5;
    } else if (benar >= 2 && benar <= 3) {
      return 2;
    } else if (benar == 1) {
      return 1;
    } else {
      return 0;
    }
  }
}

function ielts_reading(benar, tipe_tes) {
  if (tipe_tes == "IELTS Academic") {
    if (benar >= 39 && benar <= 40) {
      return 9;
    } else if (benar >= 37 && benar <= 38) {
      return 8.5;
    } else if (benar >= 35 && benar <= 36) {
      return 8;
    } else if (benar >= 33 && benar <= 34) {
      return 7.5;
    } else if (benar >= 30 && benar <= 32) {
      return 7;
    } else if (benar >= 27 && benar <= 29) {
      return 6.5;
    } else if (benar >= 23 && benar <= 26) {
      return 6;
    } else if (benar >= 19 && benar <= 22) {
      return 5.5;
    } else if (benar >= 15 && benar <= 18) {
      return 5;
    } else if (benar >= 13 && benar <= 14) {
      return 4.5;
    } else if (benar >= 10 && benar <= 12) {
      return 4;
    } else if (benar >= 8 && benar <= 9) {
      return 3.5;
    } else if (benar >= 6 && benar <= 7) {
      return 3;
    } else if (benar >= 4 && benar <= 5) {
      return 2.5;
    } else if (benar >= 2 && benar <= 3) {
      return 2;
    } else {
      return 1;
    }
  } else if (tipe_tes == "General Training") {
    if (benar == 40) {
      return 9;
    } else if (benar == 39) {
      return 8.5;
    } else if (benar >= 37 && benar <= 38) {
      return 8;
    } else if (benar == 36) {
      return 7.5;
    } else if (benar >= 34 && benar <= 35) {
      return 7;
    } else if (benar >= 32 && benar <= 33) {
      return 6.5;
    } else if (benar >= 30 && benar <= 31) {
      return 6;
    } else if (benar >= 27 && benar <= 29) {
      return 5.5;
    } else if (benar >= 23 && benar <= 26) {
      return 5;
    } else if (benar >= 19 && benar <= 22) {
      return 4.5;
    } else if (benar >= 15 && benar <= 18) {
      return 4;
    } else if (benar >= 12 && benar <= 14) {
      return 3.5;
    } else if (benar >= 9 && benar <= 11) {
      return 3;
    } else if (benar >= 6 && benar <= 8) {
      return 2.5;
    } else if (benar >= 3 && benar <= 5) {
      return 2;
    } else {
      return 0;
    }
  }
}

function skor_ielts(
  nilai_listening,
  nilai_reading,
  nilai_writing,
  nilai_speaking
) {
  skor =
    (parseFloat(nilai_listening) +
      parseFloat(nilai_reading) +
      parseFloat(nilai_writing) +
      parseFloat(nilai_speaking)) /
    4;

  return skor;
}

function ielts_writing(
  nilai_ta_1,
  nilai_cc_1,
  nilai_gra_1,
  nilai_lr_1,
  nilai_ta_2,
  nilai_cc_2,
  nilai_gra_2,
  nilai_lr_2,
  date
) {
  let task_1 = pembulatan_skor_ielts(
    (parseFloat(nilai_ta_1) +
      parseFloat(nilai_cc_1) +
      parseFloat(nilai_gra_1) +
      parseFloat(nilai_lr_1)) /
      4,
    date
  );
  let task_2 = pembulatan_skor_ielts(
    (parseFloat(nilai_ta_2) +
      parseFloat(nilai_cc_2) +
      parseFloat(nilai_gra_2) +
      parseFloat(nilai_lr_2)) /
      4,
    date
  );

  let nilai_writing = pembulatan_skor_ielts(
    (parseFloat(task_1) + parseFloat(task_2) + parseFloat(task_2)) / 3,
    date
  );

  return nilai_writing;
}

function ielts_speaking(
  nilai_topic,
  nilai_fluency,
  nilai_grammar,
  nilai_vocabulary,
  date
) {
  let nilai_speaking = pembulatan_skor_ielts(
    (parseFloat(nilai_topic) +
      parseFloat(nilai_fluency) +
      parseFloat(nilai_grammar) +
      parseFloat(nilai_vocabulary)) /
      4,
    date
  );

  return nilai_speaking;
}

function pembulatan_skor_ielts(angka, date) {
  var decimal = angka - Math.floor(angka); // hitung nilai desimal

  if (date < "2023-10-20") {
    if (decimal <= 0.25) {
      // jika desimal < 0.25
      return Math.floor(angka); // bulatkan ke bawah menjadi 0
    } else if (decimal > 0.25 && decimal <= 0.75) {
      // jika desimal >= 0.25 dan < 0.75
      return Math.floor(angka) + 0.5; // bulatkan menjadi 0.5
    } else {
      // jika desimal > 0.75
      return Math.ceil(angka); // bulatkan ke atas menjadi 1
    }
  } else {
    if (decimal < 0.25) {
      // jika desimal < 0.25
      return Math.floor(angka); // bulatkan ke bawah menjadi 0
    } else if (decimal >= 0.25 && decimal <= 0.75) {
      // jika desimal >= 0.25 dan < 0.75
      return Math.floor(angka) + 0.5; // bulatkan menjadi 0.5
    } else if (decimal > 0.75) {
      // jika desimal > 0.75
      return Math.ceil(angka); // bulatkan ke atas menjadi 1
    }
  }
}

function writing(tipe_soal, task, url) {
  if (tipe_soal == "Soal_002") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <table class="table" style="max-width: 100%">
            <tr>
                <td class="text-wrap">
                    <p>
                        <b>The chart below shows the unemployment rate and the number of people leaving Ireland from 1988 to 2008.</b>
                    </p>
                </td>

            </tr>
        </table>

        <div class="">
            <center>
                <img src="${url}public/assets/img-soal/writing-002.jpeg" alt="" class="img-fluid">
            </center>
        </div>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
            Writing Task 2
        </p>

        <table class="table">
            <tr>
                <td class="text-wrap">
                    <p>
                        <b>Some people think that older school children should learn a wide range of subjects and develop knowledge. Others think that they should only study a small number of subjects in details. </b>
                    </p>
                    <p>
                        <b>Discuss both views and give your opinion.</b>
                    </p>
                </td>
            </tr>
        </table>
      `;
    }
  } else if (tipe_soal == "Soal_GT_002") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <p>You have a penfriend living in another country and he/she is curious to know about the major news items in your country.</p>
        <p>Briefly describe ONE news story that has been on TV, onl the radio, or in the newspapers in your country, and explain why people are interested in it.</p>
        <p>You should write at least 150 words.</p>
        <p>You do NOT need to write your own address. Begin your letter as follows:</p>
        <p>Dear _______,</p>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
          Writing Task 2
        </p>
        <p>As part of a class assignment you have to write about the following topic.</p>
        <p>A healthy person is often described as someone who has a good diet, gets lots of exercise, and avoids stress.</p>
        <p>What do people do to stay healthy in your country?</p>
        <p>You should write at least 250 words.</p>
      `;
    }
  } else if (tipe_soal == "Soal_003") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <center><img src="${url}public/assets/img-soal/writing-003.png" alt="" class="img-fluid"></center>

        <p><i>The diagrams show a structure that is used to generate electricity from wave power. Write a report for a university lecturer describing the information Write at least 150 words.</i></p>
      `;
    } else if (task == 2) {
      return `
      <p class="question mb-3">
        Writing Task 2
      </p>
      <table class="tableSoal">
          <tr>
              <td class="text-wrap">
                  Many museums and historical sites are mainly visited by tourists but not local people. Why is this the case and what can be done to attract more local people to visit these places?
              </td>
          </tr>
      </table>

      <p>Give reasons for your answer and include any relevant examples from your own knowledge or experience.</p>
      <p>Write at least 250 words.</p>
      `;
    }
  } else if (tipe_soal == "Soal_GT_003") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <table class="tableSoal">
            <tr>
                <td class="text-wrap">
                    <p>Your neighbour keeps his/her animal in the garden. Write to him/her about it and the inconvenience it causes you and your family. In your </p>letter:
                    <p>• tell them what the problem is</p>
                    <p>• explain why it causes inconvenience</p>
                    <p>• suggest a possible solution to it</p>
                    <p>• say what actions you might take if the need arises.</p>
                </td>
            </tr>
        </table>

        <p>You should write at least 150 words </p>
        <p>You do NOT need to write any addresses </p>
        <p>Begin your letter as follows:</p>
        <p>Dear……….,</p>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
          Writing Task 2
        </p>
        <table class="tableSoal">
            <tr>
                <td class="text-wrap">
                    In many countries, as people are earning more these days, they are also spending money in buying more and more items. Do you think it is positive or a negative development?
                </td>
            </tr>
        </table>

        <p>Give reasons for your answer and include any relevant examples from your own knowledge or experience.</p>
        <p>Write at least 250 words.</p>
      `;
    }
  } else if (tipe_soal == "Soal_Academic_Post_Test") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <img src="${url}public/assets/img-soal/writing-academic-post-test-001.png" alt="" class="img-fluid">
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
          Writing Task 2
        </p>
        <p>Write about the following topic:</p>
        <table class="tableSoal w-100 mb-3">
            <tr>
                <td class="text-wrap">
                    <i>
                        Being a celebrity-such as a famous film star or sports personality-brings problems as well as benefits. <br>
                        Do you think that being a celebrity brings more benefits or more problems?
                    </i>
                </td>
            </tr>
        </table>

        <p>
            Give reasons for your answer and include any relevant examples from your own knowledge or experience<br>
            Write at least 250 words.
        </p>
      `;
    }
  } else if (tipe_soal == "Soal_Academic_Pretest") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <p><i>The graph below shows unemployment rates in the US and Japan from March 1993 to 1999. Summarise the information by selecting and reporting the main features, and make comparisons where relevant.</i></p>
        <p>Write at least 150 words.</p>

        <img src="${url}public/assets/img-soal/writing-academic-pretest-001.jpg" alt="" class="img-fluid">
      `;
    } else if (task == 2) {
      return `
      <p class="question mb-3">
        Writing Task 2
      </p>
      <table class="tableSoal">
          <tr>
              <td class="text-wrap">
                  Some people believe that living in big cities is becoming more difficult. Others believe that it is getting easier. Discuss both views and give your own opinion.
              </td>
          </tr>
      </table>

      <p>Write at least 250 words.</p>
      `;
    }
  } else if (tipe_soal == "Soal_General_Post_Test") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <p>Write about the following topic:</p>
        <table class="tableSoal w-100 mb-3">
            <tr>
                <td class="text-wrap">
                    <i>A friend has agreed to look after your house and pet while you are on holiday. Write a letter to your friend. In your letter:</i>
                    <ul type="radio">
                        <li>give contact details for when you are away</li>
                        <li>give instructions about how to care for your pet</li>
                        <li>describe other household duties</li>
                    </ul>
                </td>
            </tr>
        </table>

        <p>
            Write at least 150 words. You do NOT need to write any addresses.<br>
            Begin your letter as follows:<br>
            Dear____________________________,
        </p>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
          Writing Task 2
        </p>
        <table class="tableSoal w-100 mb-3">
            <tr>
                <td class="text-wrap">
                    <i>
                        Being a celebrity-such as a famous film star or sports personality-brings problems as well as benefits. <br>
                        Do you think that being a celebrity brings more benefits or more problems?
                    </i>
                </td>
            </tr>
        </table>

        <p>
            Give reasons for your answer and include any relevant examples from your own knowledge or experience<br>
            Write at least 250 words
        </p>
      `;
    }
  } else if (tipe_soal == "Soal_General_Pretest") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <table class="tableSoal">
            <tr>
                <td class="text-wrap">
                    <i>
                        You have a penfriend living in another country and he/she is curious to know about the major news items in your country.<br>
                        Briefly describe ONE news story that has been on TV, on the TV radio, or in the newspapers in your country, and explain why people are interested in it. 
                    </i>
                </td>
            </tr>
        </table>

        <p>
            You should write at least 150 words.<br>
            You do NOT need to write your own address. <br>
            Begin your letter as follows:<br>
            Dear, __________________________
        </p>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
          Writing Task 2
        </p>
        <table class="tableSoal">
            <tr>
                <td class="text-wrap">
                    <i>Some people believe that living in big cities is becoming more difficult. Others believe that it is getting easier. Discuss both views and give your own opinion.</i>
                </td>
            </tr>
        </table>

        <p>Write at least 250 words.</p>
      `;
    }
  } else if (tipe_soal == "Transforme_GT_03") {
    if (task == 1) {
      return `
        <p class="question mb-3">
            Writing Task 1<br>
            You should spend about 20 minutes on this task.
        </p>

        <div class="ps-4">
            <p><b>You have recently started work in a new company.</b></p>
            <p><b>Write a letter to an English-speaking friend. In your letter</b></p>
            <ul>
                <li>
                    <b>explain why you changed jobs</b>
                </li>
                <li>
                    <b>describe your new job</b>
                </li>
                <li>
                    <b>tell him/her your other news</b>
                </li>
            </ul>
        </div>

        <p>You should write at least 150 words.</p>
        <p>You do <b>NOT</b> need to write your own address. Begin your letter as follows:</p>
        <p><b>Dear …………….,</b></p>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
            Writing Task 2<br>
            You should spend about 40 minutes on this task.
        </p>
        <p>Write about the following topic:</p>
        <div class="ps-4">
            <p><b>Some people prefer to live in a house, while others feel that there are more advantages to living in an apartment.</b></p>
            <p><b>Are there more advantages than disadvantages of living in a house compared with living in an apartment?</b></p>
        </div>
        <p>Give reasons for your answer and include any relevant examples from your own knowledge or experience.</p>
        <p>Write at least 250 words</p>
      `;
    }
  } else if (tipe_soal == "Transforme_AC_03") {
    if (task == 1) {
      return `
        <p class="question mb-3">
            WRITING TASK 1<br>
        </p>
        <p>
            You should spend about 20 minutes on this task 
        </p>

        <p class="ps-3"><b><i>The charts below show the main reasons for study among students of different age groups and the amount of support they received from employers.</i></b></p>
        <p class="ps-3"><b><i>Summarise the information by selecting and reporting the main features, and make comparisons where relevant.</i></b></p>
        <p>Write at least 150 words.</p>

        <img src="${url}public/assets/img-soal/transforme/ac-03/w-1.png" alt="" class="img-fluid">
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
            WRITING TASK 2<br>
        </p>
        <p>
            You should spend about 40 minutes on this task<br>
            Write about the following topic:
        </p>

        <p class="ps-3"><b><i>In some countries, young people are encouraged to work or travel for a year between finishing high school and starting university studies.</i></b></p>
        <p class="ps-3"><b><i>Discuss the advantages and disadvantages for young people who decide to do this.</i></b></p>
        
        <p>Give reasons for your answer and include any relevant examples from your own knowledge or experience. </p>
        <p>Write at least 250 words.</p>
      `;
    }
  } else if (tipe_soal == "Transforme_GT_04") {
    if (task == 1) {
      return `
        <p class="question mb-3">
            Writing Task 1<br>
            You should spend about 20 minutes on this task.
        </p>

        <div class="ps-4">
            <p><b>Last month you had a holiday overseas where you stayed with some friend. They have just sent you some photos of your holiday.</b></p>
            <p><b>Write a letter to an English-speaking friend. In your letter</b></p>
            <ul>
                <li>
                    <b>Thank them for the photos and for the holiday</b>
                </li>
                <li>
                    <b>Explain why you didn’t write earlier</b>
                </li>
                <li>
                    <b>Invite them to come and stay with you</b>
                </li>
            </ul>
        </div>

        <p>You should write at least 150 words.</p>
        <p>You do <b>NOT</b> need to write your own address. Begin your letter as follows:</p>
        <p><b>Dear …………….,</b></p>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
            Writing Task 2<br>
            You should spend about 40 minutes on this task.
        </p>
        <p>Write about the following topic:</p>
        <div class="ps-4">
            <p><b>Some people feel that entertainers (e.g. film stars, pop musicians or sports stars) are paid too much money.</b></p>
            <p><b>Do you agree or disagree?</b></p>
            <p><b>Which other types of job should be highly paid?</b></p>
        </div>
        <p>Give reasons for your answer and include any relevant examples from your own knowledge or experience.</p>
        <p>Write at least 250 words</p>
      `;
    }
  } else if (tipe_soal == "Transforme_AC_04") {
    if (task == 1) {
      return `
          <p class="question mb-3">
              Writing Task 1<br>
              You should spend about 20 minutes on this task.
          </p>

          <div class="ps-4">
              <p><b>The take below gives information about the underground railway systems in six cities.</b></p>
              <p><b>Summarise the information by selecting and reporting the main features, and make comparisons where relevant.</b></p>
          </div>

          <p>You should write at least 150 words.</p>
          <p><center><b>Underground Railways Systems</b></center></p>

          <table class="tableSoal w-100">
              <tr>
                  <td><b>City</b></td>
                  <td><b>Date opened</b></td>
                  <td><b>Kilometres of route</b></td>
                  <td><b>Passengers per year <br>(in  millions)</b></td>
              </tr>
              <tr>
                  <td><b>London</b></td>
                  <td>1863</td>
                  <td>394</td>
                  <td>775</td>
              </tr>
              <tr>
                  <td><b>Paris</b></td>
                  <td>1900</td>
                  <td>199</td>
                  <td>1191</td>
              </tr>
              <tr>
                  <td><b>Tokyo</b></td>
                  <td>1927</td>
                  <td>155</td>
                  <td>1927</td>
              </tr>
              <tr>
                  <td><b>Washington DC</b></td>
                  <td>1976</td>
                  <td>126</td>
                  <td>144</td>
              </tr>
              <tr>
                  <td><b>Kyoto</b></td>
                  <td>1981</td>
                  <td>11</td>
                  <td>45</td>
              </tr>
              <tr>
                  <td><b>Los Angeles</b></td>
                  <td>2001</td>
                  <td>28</td>
                  <td>50</td>
              </tr>
          </table>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
            Writing Task 2<br>
            You should spend about 40 minutes on this task.
        </p>
        <p>Write about the following topic:</p>
        <div class="ps-4">
            <p><b>Research indicates that the characteristics we are born with have much more influence on our personality and development than any experiences we may have in our life.</b></p>
            <p><b>Which do you consider to be the major influence?</b></p>
        </div>
        <p>Give reasons for your answer and include any relevant examples from your own knowledge or experience.</p>
        <p>Write at least 250 words</p>
      `;
    }
  }
}

// soal toefl
function required(form) {
  let eror = 0;
  $.each($(form + " .required"), function () {
    if ($(this).val() == "") {
      eror = 1;
      console.log($(this).attr("name"));
      $(this).addClass("bg-red-lt");
    } else {
      $(this).removeClass("bg-red-lt");
    }
  });

  return eror;
}
