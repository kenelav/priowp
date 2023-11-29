console.log('Первое задание')

function LeapYear(year){
    if (year % 400 == 0) console.log(year," - високосный, 366 дней в году")
    else {
        if (year % 100 == 0) console.log(year, ' - невисокосный, 365 дней в году');
        else {
            if (year % 4 == 0) console.log(year," - високосный, 366 дней в году")
            else {
                console.log(year, ' - невисокосный, 365 дней в году');}
                }
    }


}

LeapYear(2022)
LeapYear(1999)
LeapYear(1996)
LeapYear(1700)
LeapYear(1704)
LeapYear(1600)


console.log('Второе задание А')
function Massive_summ(stack){
    console.log(stack, "Исходный массив");
    let size = stack.length;
    let count = parseFloat(0);
    for (let i=1; i < size - 1; i++){
        if (Math.abs(Math.sqrt(parseFloat(stack[i]))-Math.cbrt(parseFloat(stack[i]))) <= 1e-5) {count = count + stack[i];} 
    }
    console.log(count, "полученная сумма")
}
var smth = [0.25, 0.5, 0.1, 0.75, 0.0007, 32e-18, 1231e-20, 0, 2.3, 3, 4, 5];
Massive_summ(smth);

console.log('Второе задание Б')
function Massive_delete(stack){
    console.log(stack, "Исходный массив");
    let size = stack.length;
    let new_stack = [];
    for (let i=0; i < size; i++){
        let str = stack[i].toString(); 
        let isodd = 0;
        for (let j=0; j < str.length; j++)
        {
            if (str[j] != '.') {isodd = isodd + parseInt(str[j]);}
        }
        if (isodd % 2 == 1) {new_stack.push(stack[i])}
    }
    console.log(new_stack, "Новый массив")
}

var smth_sec = [0.25, 0.5, 0.1, 0.75, 0.0007, 0, 2.3, 3, 4, 172348,123, 13, 13, 4245 ];
Massive_delete(smth_sec)

console.log('Четвертое задание')
function split_for3(txt) {
    console.log(txt, '- исходная строка')
    let str = txt.toString()
    let f_let = 0;
    let s_let = 1;
    let t_let = 2;
    
    while(f_let <= str.length -1 ) {
        if (s_let > str.length -1) {console.log(str[f_let]);break;}
        if (t_let > str.length -1) {console.log(str[f_let] + str[s_let]);break;}
        console.log(str[f_let] + str[s_let] + str[t_let])
        f_let+=3;
        s_let+=3;
        t_let+=3;
        
    }
}
split_for3('5')
split_for3('ad')
split_for3('ad123g')
split_for3('acvbsadbsadaskdnaskkmqewpl')