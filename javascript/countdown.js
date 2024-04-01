/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
function initializeCountdown(gridItem) {
    var endDateString = gridItem.querySelector("#datetime").getAttribute("value");
    var endDate = new Date(endDateString);
    var startDate = new Date();
    var distance = endDate.getTime() - startDate.getTime();
    distance = parseInt(distance / 1000);
    repeatCall();

    function repeatCall() {
        distance = distance - 1;
       // console.log(distance);
        var day = getDays(distance);
        var resultDiv = gridItem.querySelector("#days");
        resultDiv.innerHTML = day;
        var remainder = distance - day * (60 * 60 * 24);
        var hour = getHours(remainder);
        var resultDiv1 = gridItem.querySelector("#hours");
        resultDiv1.innerHTML = hour;
        var remainder2 = remainder - hour * (60 * 60);
        var min = getMin(remainder2);
        var resultDiv2 = gridItem.querySelector("#minutes");
        resultDiv2.innerHTML = min;
        var remainder3 = remainder2 - min * 60;
        var resultDiv3 = gridItem.querySelector("#seconds");
        resultDiv3.innerHTML = remainder3;
    }

    function getDays(seconds) {
        var day = seconds / (60 * 60 * 24);
        return parseInt(day);
    }

    function getHours(seconds)
    {
        var hour = seconds / (60 * 60);
        return parseInt(hour);
    }

    function getMin(seconds)
    {
        var min = seconds / 60;
        return parseInt(min);
    }
    
    setInterval(repeatCall, 1000);

}
document.querySelector('.grid-item').addEventListener('mouseover', overing);
document.querySelector('.grid-item').addEventListener('mouseout', outing);
function overing(gridItem){
    console.log(gridItem.querySelector("#description").getAttribute("value"));
}
function outing(ev){
   

}