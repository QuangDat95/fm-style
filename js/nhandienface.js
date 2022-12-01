'use strict';

// let LinkApi = "https://localhost/fmstylemoi.vn/";



// Put variables in global scope to make them available to the browser console.
const constraints = window.constraints = {
    audio: false,
    video: true
};

// const capture = document.querySelector('#capture'); // this line use draw picture into convas when click it
const video = document.querySelector('video');
// const img = document.querySelector('#getimg');

video.width = 600;
video.height = 400;
// const sendAjax = (endpoint, method, data) =>
// {
//     return $.ajax({
//         type: method ? method : "GET",  // http method
//         url: LinkApi + endpoint,
//         dataType: 'json',
//         data: data,  // data to submit
//     });
// }

//api face ai
// Promise.all([
//     faceapi.nets.tinyFaceDetector.loadFromUri('./js/model/models'),
//     faceapi.nets.faceLandmark68Net.loadFromUri('./js/model/models'),
//     faceapi.nets.faceRecognitionNet.loadFromUri('./js/model/models'),
//     // faceapi.nets.faceExpressionNet.loadFromUri('./js/model/models'),
//     faceapi.nets.ssdMobilenetv1.loadFromUri('./js/model/models'),
// ]).then(init)
// const imageUpload = document.getElementById('imageUpload')
// async function start()
// {
//     const container = document.getElementById('img_check');
//     // container.style.position = 'relative';
//     // document.body.append(container)
//     // const labeledFaceDescriptors = await loadLabeledImages()
//     // const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
//     let image
//     let canvas
//     document.body.append('Loaded')
//     imageUpload.addEventListener('change', async () =>
//     {
//         if (image) image.remove()
//         if (canvas) canvas.remove()
//         image = await faceapi.bufferToImage(imageUpload.files[0])
//         // image.id = "imgcheck";
//         container.append(image)
//         canvas = faceapi.createCanvasFromMedia(image)
//         canvas.id = "face";
//         container.append(canvas)
//         const displaySize = { width: image.width, height: image.height }
//         faceapi.matchDimensions(canvas, displaySize)
//         const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
//         const resizedDetections = faceapi.resizeResults(detections, displaySize)
//         // const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
//         results.forEach((result, i) =>
//         {
//             const box = resizedDetections[i].detection.box
//             // const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
//             drawBox.draw(canvas)
//         })
//     })
// }
// video.addEventListener('play', async () =>
// {
//     const canvas = faceapi.createCanvasFromMedia(video)
//     canvas.id = "face";
//     document.getElementById("video_camnera").appendChild(canvas);
//     // document.body.append(canvas)

//     const labeledFaceDescriptors = await loadLabeledImages()
//     const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)

//     const displaySize = { width: video.videoWidth, height: video.videoHeight }
//     // const displaySize = { width: 640, height: 480 }
//     // console.log(displaySize);
//     faceapi.matchDimensions(canvas, displaySize)
//     setInterval(async () =>
//     {
//         const detections = await faceapi.detectAllFaces(
//             video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions().withFaceDescriptors()
//         const resizedDetections = faceapi.resizeResults(detections, displaySize)
//         canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
//         const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))

//         results.forEach((result, i) =>
//         {
//             const box = resizedDetections[i].detection.box
//             const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
//             drawBox.draw(canvas)
//         })
//         // faceapi.draw.drawDetections(canvas, resizedDetections)
//     }, 50)
// })


function loadLabeledImages()
{
    const labels = ["datdoan"]
    return Promise.all(
        labels.map(async label =>
        {
            const descriptions = []
            for (let i = 1; i <= 2; i++) {
                const img = await faceapi.fetchImage(`./upload/labeled_images/${label}/${i}.jpg`)
                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                descriptions.push(detections.descriptor)
            }

            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        })
    )
}


// this line use draw picture into convas
// capture.onclick = function() {
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
// };

// face ai

// +++++++++++++++++++++++++++++++

// document.getElementById("ccong").onclick = async () =>
// {

//     // convert img from video
//     const canvas = window.canvas = document.getElementById('capture');

//     // let url = ConvertCanvasToImg(canvas, video);
//     // let img = document.getElementById("cap");
//     // img.src = url;
//     // phát hện 
//     // detectFace(canvas);

//     // convert image from face
//     // const faces = window.canvas = document.getElementById('face');

//     // let context = canvas.getContext("2d");
//     // context.drawImage(video, 0, 0);
//     // context.drawImage(faces, 0, 0);
//     // let url = canvas.toDataURL();

//     let IdUser = document.getElementById("ma").value;
//     // console.log(url)
//     let url = ConvertCanvasToImg(canvas, video);
//     let img = document.getElementById("img_cap");
//     img.src = url;
//     let data = {
//         IdUser: IdUser,
//         url: url
//     }
//     // send ajax
//     // console.log(JSON.stringify(data));

//     const sendimg = sendAjax("sources/adminat/storeImg.php", "POST", {
//         data: JSON.stringify(data)
//     });

//     sendimg.done(function (response, textStatus, jqXHR)
//     {
//         // Log a message to the console
//         console.log(response);
//         localStorage.setItem("imguser", response.data);
//     });
//     sendimg.fail(function (jqXHR, textStatus, errorThrown)
//     {
//         // Log the error to the console
//         console.error("The following error occurred: " + textStatus, errorThrown);
//     });
// }
// hàm phát hiện khuôn mặt

async function detectFace(input)
{
    // Detect Face
    // const input = document.getElementById("myImg");
    const result = await faceapi
        .detectSingleFace(input, new faceapi.SsdMobilenetv1Options())
        .withFaceLandmarks()
        .withFaceDescriptor();
    const displaySize = { width: input.width, height: input.height };
    // resize the overlay canvas to the input dimensions
    const face = document.getElementById("face");
    faceapi.matchDimensions(face, displaySize);
    const resizedDetections = faceapi.resizeResults(result, displaySize);
    console.log(resizedDetections);
    console.log("height " + resizedDetections.alignedRect._box._height);
    console.log("width " + resizedDetections.alignedRect._box._width);
    console.log("x " + resizedDetections.alignedRect._box._x);
    console.log("y " + resizedDetections.alignedRect._box._y);
    const crop = document.getElementById('crop');
    const ctx = crop.getContext('2d');
    ctx.drawImage(input, resizedDetections.alignedRect._box._x, resizedDetections.alignedRect._box._y, 80, 110, 10, 10, resizedDetections.alignedRect._box._width + 150, resizedDetections.alignedRect._box._height + 150);
    faceapi.draw.drawDetections(face, resizedDetections)
}


// convert cavas to img
const ConvertCanvasToImg = (canvas, input) =>
{
    // init canvas with video input
    canvas.width = input.width;
    canvas.height = input.height;
    canvas.getContext('2d').drawImage(input, 0, 0, canvas.width, canvas.height);
    let ctx = canvas.getContext("2d");
    //draw a red box
    ctx.fillStyle = "#FF0000";
    ctx.fillRect(10, 10, 30, 30);
    let url = canvas.toDataURL();
    return url;
}
// this line if conect success
function handleSuccess(stream)
{
    const video = document.querySelector('video');
    const videoTracks = stream.getVideoTracks();
    console.log('Got stream with constraints:', constraints);
    console.log(`Using video device: ${videoTracks[0].label}`);
    window.stream = stream; // make variable available to browser console
    video.srcObject = stream;
}
// this line if conect fail
function handleError(error)
{
    if (error.name === 'ConstraintNotSatisfiedError') {
        let v = constraints.video;
        console.log(v.width.exact)
        errorMsg(`The resolution ${v.width.exact}x${v.height.exact} px is not supported by your device.`);
    } else if (error.name === 'PermissionDeniedError') {
        errorMsg('Permissions have not been granted to use your camera and ' +
            'microphone, you need to allow the page access to your devices in ' + 'order for the demo to work.');
    }
    errorMsg(`getUserMedia error: ${error.name}`, error);
}
// show err
function errorMsg(msg, error)
{
    const errorElement = document.querySelector('#errorMsg');
    errorElement.innerHTML += `<p>${msg}</p>`;
    if (typeof error !== 'undefined') {
        console.error(error);
    }
}

const GetImgLocal = () =>
{
    let imgurl = localStorage.getItem("imguser");

    if (imgurl) {
        document.getElementById("img_cap").src = imgurl;
        // const canvas = window.canvas = document.getElementById('capture');
        // let url = ConvertCanvasToImg(canvas, imgurl);
        // console.log(imgurl);
    }
}
// init
// run first    
(async function init()
{
    GetImgLocal();
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);

        // console.log(stream)
        handleSuccess(stream);
        // e.target.disabled = true;
    } catch (e) {
        handleError(e);
    }
})();
    // this line init to start connect camera
    // document.querySelector('#showVideo').addEventListener('click', e => init(e));