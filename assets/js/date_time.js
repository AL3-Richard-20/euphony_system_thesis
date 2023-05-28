
function date_time(id)
{
        date = new Date;

        year = date.getFullYear();

        month = date.getMonth();

        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

        d = date.getDate();

        day = date.getDay();

        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

        //Hours
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        //Hours END

        //Minutes
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        //Minutes END

        //Seconds
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        //Seconds END

        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;

        // result = days[day];

        document.getElementById(id).innerHTML = result;

        setTimeout('date_time("'+id+'");','1000');

        return true;
}

function day(id)
{
        date = new Date;

        d = date.getDate();

        day = date.getDay();

        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

        result = days[day];

        // document.getElementById(id).innerHTML = result + " Class (Today)";

        document.getElementById(id).value = result;

        setTimeout('day("'+id+'");','1000');

        return true;
}

function time(id)
{
        date = new Date;

        d = date.getDate();

        //Hours
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        //Hours END

        result = h;

        // result = days[day];

        document.getElementById(id).value = result;

        setTimeout('time("'+id+'");','1000');

        return true;
}

function the_date(id){
        
        date = new Date;

        year = date.getFullYear();

        month = date.getMonth();

        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

        d = date.getDate();

        result = ' '+months[month]+' '+d+' '+','+' '+year+' ';

        document.getElementById(id).value = result;

        setTimeout('the_date("'+id+'");','1000');

        return true;
}
