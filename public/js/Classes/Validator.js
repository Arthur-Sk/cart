class Validator{

    static isInt(value){
        return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value));
    }

    static maxNum(value, rule){
        return value <= rule;
    }
}