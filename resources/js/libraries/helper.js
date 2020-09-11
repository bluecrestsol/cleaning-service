const _ = require('lodash');
// Check if value is not null
var isNotNull = function(obj) {
    return typeof obj !== 'undefined' && obj !== null && obj !== '';
};
// Remove null properties from object
var clean = function(obj) {
    var newObj = {};
    Object.keys(obj).forEach((key) => {
        if (isNotNull(obj[key])) {
            newObj[key] = obj[key];
        }
    });
    return newObj;
};
module.exports = {
    isNotNull,
    clean,
    // Get value
    getValue(obj) {
        var value = '';
        if (isNotNull(obj)) {
            value = obj;
        }
        return value;
    },
    // Capitalize string
    capitalize(str) {
        var newStr = '';
        if (isNotNull(str)) {
            newStr = str.charAt(0).toUpperCase() + str.slice(1);
        }
        return newStr;
    },
    // Get ascii value of a character
    ascii(a) {
        return a.charCodeAt(0);
    },
    // Find/get key by value in an object
    getKeyByValue(object, value) {
        return Object.keys(object).find(key => object[key] === value);
    },
    // Add input hidden value to a specific form
    addValueToForm($form, name, value) {
        $("<input />").attr("type", "hidden")
            .attr("name", name)
            .attr("value", value)
            .appendTo($form);
    },
    // Pluck keys or null
    pluckOrElse(list, key) {
        return list.map(function(item) {
            return item[key] ?? item;
        });
    },
    // Check if list has any of the keys specified
    hasAny(list, keys) {
        return keys.some(function(key) {
            return list.includes(key);
        });
    },
    // Convert data to utc format
    toUtcFormat(value, format) {
        var object = moment.utc(value);
        return object.isValid() ? object.format(format) : null;
    },
    formatDate(value, format, timezone) {
        if (!isNotNull(value)) {
            return null;
        }
        value = moment(value);
        return ((isNotNull(timezone)) ? value.tz(timezone) : value).format(format);
    },
    // Transfer values from one object to another
    transferValues(to, from, keys) {
        if (isNotNull(from)) {
            keys.forEach(function(key) {
                var value = _.get(from, key.from, key.fallback) ?? key.fallback;
                if (key.callback) {
                    value = key.callback(value);
                }
                _.set(to, key.to, value);
            });
        }
    },
    // Format number with commas
    numberWithCommas(value) {
        if (!isNotNull(value))
            return null;
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    // Format number to get only decimal points if exists
    decimal(value) {
        return value.replace(/\.0+$/,'')
    },
    // Implode array values (exclude values that are null)
    implode(values, separator) {
        values = values.filter(function(value) { return isNotNull(value); });
        separator = separator ?? ' ';
        var str = '';
        var len = values.length;
        for (ctr = 0; ctr < len; ctr++) {
            var value = values[ctr];
            if (isNotNull(value)) {
                str += value;
                if (ctr < len-1) {
                    str += separator;
                }
            }
        }
        return str;
    },
    // Format sort arrays to parameter format e.g asc(name)
    formatSortParams(list) {
        var str = '';
        var len = list.length;
        for (ctr = 0; ctr < len; ctr++) {
            var item = list[ctr];
            str += `${item.dir}(${item.column})`;
            if (ctr < len-1) {
                str += ',';
            }
        }
        return str;
    },
    params(obj) {
        var params = $.param(clean(obj));
        console.log('params', clean(obj));
        return isNotNull(params) ? `?${params}` : '';
    }
};
