function isDigit(charCode)
{
    return (charCode >= 48 && charCode <= 57)
}
function isLat(charCode)
{
    return ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122))
}
function isRus(charCode)
{
    return (charCode >= 1040 && charCode <= 1103)
}
function filter(evt, set, exc, x)
{ //set= 1 - digit 2 - lat 4 - rus; x=special set
    evt = (evt) ? evt : ((event) ? event : null);
    if (evt)
    {
        var charCode = (evt.charCode || evt.charCode == 0) ? evt.charCode :
                ((evt.keyCode) ? evt.keyCode : evt.which);
//alert(charCode);
        if (charCode > 13 && !x ^ (!(set & 1 && isDigit(charCode)) && !(set & 2 && isLat(charCode)) && !(set & 4 && isRus(charCode)) && exc.indexOf(String.fromCharCode(charCode)) == -1))
        {
            if (evt.preventDefault)
            {
                evt.preventDefault();
            } else
            {
                evt.returnValue = false;
                return false;
            }
        }
    }
}

function isNumeric(str)
{
    if (str.length == 0) return false;
    for (var i = 0; i < str.length; i++)
    {
        var ch = str.substring(i, i + 1);
        if (ch < "0" || ch > "9" || str.length == null)  return false;
    }
    return true;
}

function validDecimal(number)
{
	 var regEx =/^[0-9]+(\.[0-9]+)?$/;  
	 return regEx.test(number);
}
/**
 * Displays an confirmation box beforme to submit a "EXIT/DELETE" operations.
 * This function is called while clicking links
 *
 * @param   object   the link
 * @param   string   confirm message
 *
 * @return  boolean  whether to run the query or not
 */
function confirmLink(theLink, confirmMsg)
{
    // Confirmation is not required in the configuration file
    // or browser is Opera (crappy js implementation)
    if (confirmMsg == '' || typeof(window.opera) != 'undefined')
    {
        return true;
    }

    var is_confirmed = confirm(confirmMsg);
    if (is_confirmed)
    {
        theLink.href += '&is_js_confirmed=1';
    }

    return is_confirmed;
} // end of the 'confirmLink()' function


function Go(link)
{
    document.location = link;
    return true;
}

function CGo(link, mesg)
{
    if (confirm(mesg))
    {
        document.location = link;
        return true;
    }
}

function _v(id)
{
    return document.getElementById(id);
}


function in_arrayi(needle, haystack)
{
    var len = haystack.length;
    needle = needle.toLowerCase();
    for (var i = 0; i < len; i++)
    {
        if (needle == haystack[i].toLowerCase())
            return true;
    }

    return false;
}

function verify_email(email)
{
    if (7 > email.length)
        return false;

    var zones = new Array(
            'ac', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'aq', 'ar', 'as', 'at', 'au', 'aw', 'az',
            'ax', 'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv',
            'bw', 'by', 'bz', 'ca', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cr', 'cs',
            'cu', 'cv', 'cx', 'cy', 'cz', 'de', 'dj', 'dk', 'dm', 'do', 'dz', 'ec', 'ee', 'eg', 'eh', 'er', 'es',
            'et', 'eu', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr', 'ga', 'gb', 'gd', 'ge', 'gf', 'gg', 'gh', 'gi', 'gl',
            'gm', 'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm', 'hn', 'hr', 'ht', 'hu', 'id',
            'ie', 'il', 'im', 'in', 'io', 'iq', 'ir', 'is', 'it', 'je', 'jm', 'jo', 'jp', 'ke', 'kg', 'kh', 'ki',
            'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu', 'lv',
            'ly', 'ma', 'mc', 'md', 'mg', 'mh', 'mk', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mu',
            'mv', 'mw', 'mx', 'my', 'mz', 'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nu', 'nz',
            'om', 'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'ps', 'pt', 'pw', 'py', 'qa', 're',
            'ro', 'ru', 'rw', 'sa', 'sb', 'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl', 'sm', 'sn', 'so',
            'sr', 'st', 'sv', 'sy', 'sz', 'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk', 'tl', 'tm', 'tn', 'to', 'tp',
            'tr', 'tt', 'tv', 'tw', 'tz', 'ua', 'ug', 'uk', 'um', 'us', 'uy', 'uz', 'va', 'vc', 've', 'vg', 'vi',
            'vn', 'vu', 'wf', 'ws', 'ye', 'yt', 'yu', 'za', 'zm', 'zw', 'su',
            'aero', 'biz', 'cat', 'com', 'coop', 'info', 'jobs', 'mobi', 'museum', 'name', 'net',
            'org', 'pro', 'travel', 'gov', 'edu', 'mil', 'int', 'xxx'
    );

    var regEmail = /^[\w-\.]+@([\w-]+\.)+([\w-]{2,4})$/;

    var myArr = regEmail.exec(email);

    if (null == myArr)
        return false;

    if (!in_arrayi(myArr[2], zones))
        return false;

    return true;
}



function substr_count(string, substring, start, length)
{
    var c = 0;
    if (start)
    {
        string = string.substr(start);
    }
    if (length)
    {
        string = string.substr(0, length);
    }
    for (var i = 0; i < string.length; i++)
    {
        if (substring == string.substr(i, substring.length))
            c++;
    }
    return c;
}


function verify_url(url)
{
    if (4 > url.length)
        return false;

    // doubled 'http://' check
    var mtch = url.split('http://');
    if (mtch.length > 2)
    {
        return false;
    }


    var ZZZ = new RegExp("(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\\.)+(?:ru|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ax|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|su|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|aero|biz|cat|com|coop|info|jobs|mobi|museum|name|net|org|pro|travel|gov|edu|mil|int)|(?!0)(?:(?!0[^.]|255)[0-9]{1,3}\\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&?+=\\~/-]*)?(?:#[^ '\\\"&<>]*)?", "g");

    var myArr = ZZZ.exec(url);

    if (null == myArr || myArr.length == 0)
        return false;

    if (!substr_count(myArr[0], 'http://') || (1 < substr_count(myArr[0], 'http://')))
    {
        url2 = myArr[0];
        url2 = url2.replace('http://', '');
        url3 = 'http://' + url2;
    }
    else if (1 >= substr_count(myArr[0], 'http://'))
    {
        url3 = myArr[0];
    }

    return true;
}


