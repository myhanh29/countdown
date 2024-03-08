/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


var endDate = new Date('2024-02-25T11:00:00Z');
var startDate = new Date();

var distance = endDate.getTime() - startDate.getTime(); 

distance = parseInt(distance/1000);
repeatCall();
setInterval(repeatCall, 1000);

function repeatCall(){
    distance = distance-1;
    console.log(distance);
    var day= getDays(distance);
    var resultDiv = document.getElementById("days");
    resultDiv.innerHTML = day;
    var remainder= distance-day*(60*60*24);
    var hour= getHours(remainder);
    var resultDiv1 = document.getElementById("hours");
    resultDiv1.innerHTML = hour;
    var remainder2= remainder-hour*(60*60);
    var min= getMin(remainder2);
    var resultDiv2 = document.getElementById("minutes");
    resultDiv2.innerHTML = min;
    var remainder3= remainder2-min*60;
    var resultDiv3 = document.getElementById("seconds");
    resultDiv3.innerHTML = remainder3;
}

function getDays(seconds){
    var day= seconds/(60*60*24);
    return parseInt(day);
}

function getHours(seconds)
{
    var hour= seconds/(60*60);
    return parseInt(hour);
}

function getMin(seconds)
{
    var min= seconds/60;
    return parseInt(min);
}