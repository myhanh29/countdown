
console.log(eventsData);
console.log(activeDay);
let updatedEventsData = [];
let columnPosition = 1;
for (var i = 0; i < eventsData.length; i++) {
    var starttimestring = eventsData[i][1];
    var datestartPart = starttimestring.split(" ")[0];

    var endtimestring = eventsData[i][2];
    var dateendPart = endtimestring.split(" ")[0];

    if (datestartPart === dateendPart) {
        const evt = {
            starttime: eventsData[i][1],
            endtime: eventsData[i][2],
            datestart: datestartPart,
            dateend: dateendPart,
            name: eventsData[i][0],
            priority: eventsData[i][5]

        };
        console.log(evt);
        updatedEventsData.push(evt);
    } else if (datestartPart !== dateendPart)
    {
        if (activeDay === datestartPart) {
            let evt = {
                starttime: eventsData[i][1],
                endtime: new Date(datestartPart + 'T23:59:59'),
                datestart: datestartPart,
                dateend: datestartPart,
                name: eventsData[i][0],
                priority: eventsData[i][5]
            };

            updatedEventsData.push(evt);
        }

        if (activeDay > datestartPart && activeDay < dateendPart) {
            const startDate = new Date(datestartPart);
            startDate.setDate(startDate.getDate() + 1);

            const endDate = new Date(dateendPart);
            const previousDay = new Date(endDate);
            previousDay.setDate(previousDay.getDate() - 1);
            var activeDay = new Date(activeDay);
            for (let j = startDate.getDate(); j <= previousDay.getDate(); j++) {
                var year = activeDay.getFullYear();
                var month = activeDay.getMonth() + 1;
                var day = activeDay.getDate();
                var dateString = year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;


                evt = {
                    starttime: new Date(dateString + 'T00:00:00'),
                    endtime: new Date(dateString + 'T23:59:59'),
                    datestart: j,
                    dateend: j,
                    name: eventsData[i][0],
                    priority: eventsData[i][5]
                };

                updatedEventsData.push(evt);
            }
        }
        if (activeDay === dateendPart) {
            evt = {
                starttime: new Date(dateendPart + 'T00:00:00'),
                endtime: eventsData[i][2],
                datestart: dateendPart,
                dateend: dateendPart,
                name: eventsData[i][0],
                priority: eventsData[i][5]
            };
            updatedEventsData.push(evt);
        }
    }

}

const eventContainer = document.getElementById("phpEventContainer");
let eventContainerHtml = '';
let currentIndex = 0;
updatedEventsData.forEach(evt => {
    if (evt.datestart === evt.dateend) {
        const height = getHeight(evt.starttime, evt.endtime, evt.datestart, evt.dateend);
        const width = getWidth(eventsData);
        const gridColumn = getColumnPosition(width, currentIndex);
        const gridRow = getRowPosition(evt.starttime);
        const color = getColor(evt.priority);
        const eventHtml = `
        <div id="event" style="color: #000000; height: ${height}px; grid-row: ${gridRow}; grid-column: ${gridColumn}; background-color: ${color};">${evt.name}</div>
    `;
        console.log(eventHtml);

        eventContainerHtml += eventHtml;
        currentIndex++;
    }
});

eventContainer.innerHTML = eventContainerHtml;

function getHeight(starttime, endtime, datestart, dateend) {

    const start = new Date(Date.parse(starttime));
    const end = new Date(Date.parse(endtime));
    console.log(start);
    console.log(end);

    const startTimeMinutes = start.getHours() * 60 + start.getMinutes();
    const endTimeMinutes = end.getHours() * 60 + end.getMinutes();

    const duration = endTimeMinutes - startTimeMinutes;
    console.log(duration);
    const numberOfSlots = Math.ceil((duration / 15) * 25);
    console.log(numberOfSlots);

    return numberOfSlots;


}

function getWidth(eventsData)
{
    const width = 100 / eventsData.length;
    return width;
}
function getColumnCount(width) {

    const totalColumns = Math.floor(100 / width);
    return totalColumns;
}
function getColumnPosition(width, currentIndex) {
    const totalColumns = getColumnCount(width);

    const columnPosition = (currentIndex % totalColumns) + 1;
    return columnPosition;
}

function getRowPosition(starttime) {
    // if (datestart === dateend) {
    const start = new Date(starttime);
    const startMinutes = start.getHours() * 60 + start.getMinutes();
    console.log(startMinutes);
    const startPosition = Math.floor(startMinutes / 15) + 1;

    return startPosition;

}

function getColor(priority) {
    if (priority === 'Important')
    {
        color = 'red';
    } else if (priority === 'Notimportant')
    {
        color = 'green';
    } else {
        color = 'yellow';
    }
    return color;
}
