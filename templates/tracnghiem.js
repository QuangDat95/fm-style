 // select all elements
const start = document.getElementById("start");
const quiz = document.getElementById("quiz");
const question = document.getElementById("question");
const qImg = document.getElementById("qImg");
const choiceA = document.getElementById("A");
const choiceB = document.getElementById("B");
const choiceC = document.getElementById("C");
const choiceD = document.getElementById("D");
const counter = document.getElementById("counter");
const timeGauge = document.getElementById("timeGauge");
const progress = document.getElementById("progress");
progress.innerHTML = "Câu hỏi ";
const scoreDiv = document.getElementById("scoreContainer");
const questionid =  document.getElementById("question_id");


// create some variables

const lastQuestion = questions.length - 1;
let runningQuestion = 0;
let count = 0;
const questionTime = 10; // 10s
const gaugeWidth = 250; // 150px
const gaugeUnit = gaugeWidth / questionTime;
let TIMER;
let score = 0;
let traloi='';
let stt = 0;
// render a question
function renderQuestion(){
    let q = questions[runningQuestion];
    
    question.innerHTML = "<p>"+ ((runningQuestion*1)+1) + ". " + q.question +"</p>";
    questionid.innerHTML = q.id;
    qImg.innerHTML = "<img src="+ q.imgSrc +">";
    choiceA.innerHTML = q.choiceA;
    choiceB.innerHTML = q.choiceB;
    choiceC.innerHTML = q.choiceC;
    choiceD.innerHTML = q.choiceD;
}

start.addEventListener("click",startQuiz);

// start quiz
function startQuiz(){
    start.style.display = "none";
    renderQuestion();
    quiz.style.display = "block";
    renderProgress();
    renderCounter();
    TIMER = setInterval(renderCounter,1000); // 1000ms = 1s
}

// render progress
function renderProgress(){
    for(let qIndex = 0; qIndex <= lastQuestion; qIndex++){
        progress.innerHTML += "<div class='prog' id="+ qIndex +">"+((qIndex*1)+1)+"</div>";
    }
}

// counter render

function renderCounter(){
    if(count <= questionTime){
        counter.innerHTML = count + "/10s";
        timeGauge.style.width = count * gaugeUnit + "px";
        count++
    }else{
        count = 0;
        // change progress color to red
        answerIsWrong();
        if(runningQuestion < lastQuestion){
            runningQuestion++;
            renderQuestion();
        }else{
            // end the quiz and show the score
            clearInterval(TIMER);
            scoreRender();
        }
    }
}

// checkAnwer

function checkAnswer(answer){
    var question_id =  document.getElementById("question_id").innerHTML;
    traloi += ((runningQuestion*1)+1) + "@#@" + question_id + "@#@" + answer ;
    stt = stt + 1;
    if(stt<questions.length){
        traloi += "@$$@";
    }
    if( answer == questions[runningQuestion].correct){
        // answer is correct
        score++;
        // change progress color to green
        answerIsCorrect();
    }else{
        // answer is wrong
        // change progress color to red
        answerIsWrong();
    }
    count = 0;
    if(runningQuestion < lastQuestion){
        runningQuestion++;
        renderQuestion();
    }else{
        // end the quiz and show the score
        clearInterval(TIMER);
        scoreRender();
    }
}

// answer is correct
function answerIsCorrect(){
    document.getElementById(runningQuestion).style.backgroundColor = "rgb(149, 247, 139)";
}

// answer is Wrong
function answerIsWrong(){
    document.getElementById(runningQuestion).style.backgroundColor = "rgb(255, 102, 102)";
}

// score render
function scoreRender(){
    //start.style.display = "none";
    //quiz.style.display = "none";
    progress.style.textAlign="center";
    timer.style.display = "none";
    choices.style.display = "none";
    question.style.display = "none";
    scoreDiv.style.display = "block";
    
    // calculate the amount of question percent answered by the user
    const scorePerCent = Math.round(100 * score/questions.length) ;
    
    // choose the image based on the scorePerCent
    let img = (scorePerCent >= 90) ? "tracnghiem/img/5.png" :
              (scorePerCent >= 80) ? "tracnghiem/img/5.png" :
              (scorePerCent >= 60) ? "tracnghiem/img/4.png" :
              (scorePerCent >= 40) ? "tracnghiem/img/3.png" :
              (scorePerCent >= 20) ? "tracnghiem/img/2.png" : "tracnghiem/img/1.png";
    let match = (scorePerCent >= 90) ? "Rất Tốt" :
                (scorePerCent >= 80) ? "Tốt" :
              (scorePerCent >= 60) ? "Khá" :
              (scorePerCent >= 40) ? "Trung bình" :
              (scorePerCent >= 20) ? "Kém" : "Quá kém";

    scoreDiv.innerHTML = "<span>Kết quả</span>";
    scoreDiv.innerHTML += "<p><img src="+ img +"></p>";
    scoreDiv.innerHTML += "<p>" + score + "/" + questions.length + " (" + scorePerCent + "%) - " + match + "</p>";
    luuketqua(score,questions.length,scorePerCent,match,traloi);
    //alert(traloi);
}


function luuketqua(score,questions_lenght,scorePerCent,match,traloi)
{
	poststr="DATA="+ "0*@!" +  encodeURIComponent(score)+  "*@!"+ encodeURIComponent(questions_lenght)+  "*@!"+ encodeURIComponent(scorePerCent)+  "*@!"+ encodeURIComponent(match)+  "*@!"+ encodeURIComponent(traloi);
	loadtrang('khonghienthi', "tracnghiem_luutong", poststr,"xuly4") ; 
 
}
 
function xuly4()
{
	document.getElementById('nhac').play();
   //document.getElementById('nguoilap').value =   
 }

