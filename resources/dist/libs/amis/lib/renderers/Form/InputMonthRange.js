/**
 * amis v6.7.0
 * build time: 2024-08-06
 * Copyright 2018-2024 baidu
 */

'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

var tslib = require('tslib');
require('react');
var amisCore = require('amis-core');
var cx = require('classnames');
var InputDateRange = require('./InputDateRange.js');
var amisUi = require('amis-ui');
var StaticHoc = require('./StaticHoc.js');

function _interopDefaultLegacy (e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }

var cx__default = /*#__PURE__*/_interopDefaultLegacy(cx);

var __react_jsx__ = require('react');
var _J$X_ = (__react_jsx__["default"] || __react_jsx__).createElement;
(__react_jsx__["default"] || __react_jsx__).Fragment;
var MonthRangeControl = /** @class */ (function (_super) {
    tslib.__extends(MonthRangeControl, _super);
    function MonthRangeControl() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    MonthRangeControl.prototype.render = function () {
        var _a = this.props, className = _a.className; _a.style; var ns = _a.classPrefix, minDate = _a.minDate, maxDate = _a.maxDate, minDuration = _a.minDuration, maxDuration = _a.maxDuration, data = _a.data, format = _a.format, mobileUI = _a.mobileUI, valueFormat = _a.valueFormat, inputFormat = _a.inputFormat, displayFormat = _a.displayFormat, env = _a.env, rest = tslib.__rest(_a, ["className", "style", "classPrefix", "minDate", "maxDate", "minDuration", "maxDuration", "data", "format", "mobileUI", "valueFormat", "inputFormat", "displayFormat", "env"]);
        return (_J$X_("div", { className: cx__default["default"]("".concat(ns, "DateRangeControl"), className) },
            _J$X_(amisUi.DateRangePicker, tslib.__assign({ viewMode: "months", mobileUI: mobileUI, valueFormat: valueFormat || format, displayFormat: displayFormat || inputFormat, classPrefix: ns, popOverContainer: mobileUI
                    ? env === null || env === void 0 ? void 0 : env.getModalContainer
                    : rest.popOverContainer || env.getModalContainer, popOverContainerSelector: rest.popOverContainerSelector, onRef: this.getRef, data: data }, rest, { minDate: minDate
                    ? amisCore.filterDate(minDate, data, valueFormat || format)
                    : undefined, maxDate: maxDate
                    ? amisCore.filterDate(maxDate, data, valueFormat || format)
                    : undefined, minDuration: minDuration ? amisCore.parseDuration(minDuration) : undefined, maxDuration: maxDuration ? amisCore.parseDuration(maxDuration) : undefined, onChange: this.handleChange, onFocus: this.dispatchEvent, onBlur: this.dispatchEvent }))));
    };
    tslib.__decorate([
        StaticHoc.supportStatic(),
        tslib.__metadata("design:type", Function),
        tslib.__metadata("design:paramtypes", []),
        tslib.__metadata("design:returntype", void 0)
    ], MonthRangeControl.prototype, "render", null);
    return MonthRangeControl;
}(InputDateRange["default"]));
/** @class */ ((function (_super) {
    tslib.__extends(MonthRangeControlRenderer, _super);
    function MonthRangeControlRenderer() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    MonthRangeControlRenderer.defaultProps = {
        format: 'X',
        inputFormat: 'YYYY-MM',
        joinValues: true,
        delimiter: ',',
        /** shortcuts的兼容配置 */
        ranges: '',
        shortcuts: 'thismonth,prevmonth',
        animation: true
    };
    MonthRangeControlRenderer = tslib.__decorate([
        amisCore.FormItem({
            type: 'input-month-range'
        })
    ], MonthRangeControlRenderer);
    return MonthRangeControlRenderer;
})(MonthRangeControl));

exports["default"] = MonthRangeControl;
window.amisVersionInfo={version:'6.7.0',buildTime:'2024-08-06'};