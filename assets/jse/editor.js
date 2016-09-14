var link = document.querySelectorAll('.editable');
var child = link.childNodes;
//edit events
for(var i = 0; i<link.length; i++) {
    link[i].addEventListener('mouseover', function (e) {
        e.preventDefault();
        this.classList.remove('panel-info');
        this.classList.add('panel-warning');
    });
    link[i].addEventListener('mouseout', function (e) {
        e.preventDefault();
        this.classList.remove('panel-warning');
        this.classList.add('panel-info');
    });

    link[i].addEventListener('click', function (e) {
        var modal = document.querySelector('.editModal');

        if (modal){
            var pos = getOffset(this);
            //show editor
            if (modal.classList.contains('editModalDisable')){
                modal.classList.remove('editModalDisable');
            }
            modal.style.top = pos.top + 'px';
            //load data
            ajax({
                url:"/ajax/getArticle.php",
                statbox:"editPanelTitle",
                method:"POST",
                data:
                {
                    id:this.getAttribute('id')
                },
                success:function(data){
                    var arr = data.split("+split+");
                    console.log(arr);

                    document.getElementById("editTitle").value=arr[0];
                    CKEDITOR.instances['editContent'].setData(arr[1]);


                }
            });


        }

    });
}


/////////   HTML element position     /////////
function getOffset(elem) {
    if (elem.getBoundingClientRect) {
        // "правильный" вариант
        return getOffsetRect(elem)
    } else {
        // пусть работает хоть как-то
        return getOffsetSum(elem)
    }
}

function getOffsetSum(elem) {
    var top=0, left=0;
    while(elem) {
        top = top + parseFloat(elem.offsetTop);
        left = left + parseFloat(elem.offsetLeft);
        elem = elem.offsetParent;
    }
    return {top: Math.round(top), left: Math.round(left)}
}

function getOffsetRect(elem) {
    // (1)
    var box = elem.getBoundingClientRect();

    // (2)
    var body = document.body;
    var docElem = document.documentElement;

    // (3)
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;

    // (4)
    var clientTop = docElem.clientTop || body.clientTop || 0;
    var clientLeft = docElem.clientLeft || body.clientLeft || 0;

    // (5)
    var top  = box.top +  scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;

    return { top: Math.round(top), left: Math.round(left) }
}
/////////   END HTML element position     /////////





// ajax
/**
 *
 * @returns {*}
 * @constructor
 */
function XmlHttp(){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e1) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

/**
 *
 * @param param
 */
function ajax(param)
{
    var method,  send;
    if (window.XMLHttpRequest) req = new XmlHttp();
    method=(!param.method ? "POST" : param.method.toUpperCase());

    if(method=="GET")
    {
        send=null;
        param.url=param.url+"&ajax=true";
    }
    else
    {
        send="";
        for (var i in param.data) send+= i+"="+param.data[i]+"&";
        // send=send+"ajax=true"; // если хотите передать сообщение об успехе
    }

    req.open(method, param.url, true);
    var statBox;
    if(param.statbox){
        statBox = document.getElementById(param.statbox).innerHTML;
        document.getElementById(param.statbox).innerHTML = '<div style="text-align: center"><img src="/assets/img/wait.gif"></div>';
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(send);
    req.onreadystatechange = function()
    {
        if (req.readyState == 4 && req.status == 200) //если ответ положительный
        {
            document.getElementById(param.statbox).innerHTML = statBox;
            if(param.success)param.success(req.responseText);
        }
    }
}


// submit button
var submitLink = document.getElementById('editSubmit');
submitLink.addEventListener('click', function (e) {
    e.preventDefault();
    //document.getElementById("editTitle").value = CKEDITOR.instances['editContent'].getData() ;
    //CKEDITOR.instances['editContent'].setData('12345<br>67890');

    ajax({
        url:"/ajax.php",
        //statbox:"status",
        method:"POST",
        data:
        {
            title:document.getElementById("editTitle").value,
            content: CKEDITOR.instances['editContent'].getData()
        },
        success:function(data){
            var arr = data.split("<split>");
            console.log(arr);

            document.getElementById("editTitle").value=arr[0];
            CKEDITOR.instances['editContent'].setData(arr[1]);
        }
    });
});

// Cancel button



var cancelLink = document.getElementById('editCancel');

cancelLink.addEventListener('click', function (e) {
    e.preventDefault();
    var modal = document.querySelector('.editModal');
    if (!modal.classList.contains('editModalDisable')){
        modal.classList.add('editModalDisable');
    }
});