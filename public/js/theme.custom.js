/* Add here all your JS customizations */
// Upper Case
function wcUpperJS(str){
    var newStrArr = []
    var splitStr = str.toLowerCase().split(' ');
    for(var i = 0; i < splitStr.length; i++){
        var item = splitStr[i]
        item = item.split('');
        item[0] = item[0].toUpperCase();
        newStrArr.push(item.join(''))
    }
    return newStrArr.join(' ');
}