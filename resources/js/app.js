require('bootstrap');

function getMinutesBetweenDates(startDate, endDate) {
    
    let hours, minutes, diff;
    function sliceHours(params) {
        return Number(params.slice(0,2))
    }

    function sliceMinetus(params) {
        return Number(params.slice(3,-3))
    }

    diffHours = (24 - sliceHours(startDate)) + sliceHours(endDate)
    diffMin =  sliceMinetus(startDate) - sliceMinetus(endDate)

    diff = sliceMinetus(startDate) < sliceMinetus(endDate) ? diffHours - 1 && (60 + (sliceMinetus(startDate) - sliceMinetus(endDate))) : diffMin 
 
    return `${diffHours}:${diff}`
   
}
console.log(getMinutesBetweenDates('08:00:00', '06:05:00'));
