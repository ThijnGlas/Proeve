document.getElementById(3).style.display = "block"
var oldClassName = 3
function availability_display() {
    var select = document.getElementById('beheerder')
    var className = select.value
    var classSelector = document.getElementById(className)
    classSelector.style.display = "block"
    if (className != oldClassName){
        var classSelector2 = document.getElementById(oldClassName)
        classSelector2.style.display = "none"
        oldClassName = className
    }
}
