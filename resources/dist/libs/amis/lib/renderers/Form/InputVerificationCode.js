/**
 * amis v6.7.0
 * build time: 2024-08-06
 * Copyright 2018-2024 baidu
 */

'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

var tslib = require('tslib');
var React = require('react');
var amisCore = require('amis-core');
var amisUi = require('amis-ui');

function _interopDefaultLegacy (e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }

var React__default = /*#__PURE__*/_interopDefaultLegacy(React);

var __react_jsx__ = require('react');
var _J$X_ = (__react_jsx__["default"] || __react_jsx__).createElement;
(__react_jsx__["default"] || __react_jsx__).Fragment;
var VerificationCodeControl = /** @class */ (function (_super) {
    tslib.__extends(VerificationCodeControl, _super);
    function VerificationCodeControl() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    /**
     * actions finish
     * @date 2024-06-04 星期二
     * @function
     * @param {}
     * @return {}
     */
    VerificationCodeControl.prototype.onFinish = function (value) {
        return tslib.__awaiter(this, void 0, void 0, function () {
            var _a, dispatchEvent, data, rendererEvent;
            return tslib.__generator(this, function (_b) {
                switch (_b.label) {
                    case 0:
                        _a = this.props, dispatchEvent = _a.dispatchEvent, data = _a.data;
                        return [4 /*yield*/, dispatchEvent('finish', tslib.__assign(tslib.__assign({}, data), { value: value }), this)];
                    case 1:
                        rendererEvent = _b.sent();
                        if (rendererEvent === null || rendererEvent === void 0 ? void 0 : rendererEvent.prevented) {
                            return [2 /*return*/];
                        }
                        return [2 /*return*/];
                }
            });
        });
    };
    /**
     * actions change
     * @date 2024-06-04 星期二
     * @function
     * @param {}
     * @return {}
     */
    VerificationCodeControl.prototype.onChange = function (value) {
        return tslib.__awaiter(this, void 0, void 0, function () {
            var _a, onChange, data, dispatchEvent, rendererEvent;
            return tslib.__generator(this, function (_b) {
                switch (_b.label) {
                    case 0:
                        _a = this.props, onChange = _a.onChange, data = _a.data, dispatchEvent = _a.dispatchEvent;
                        return [4 /*yield*/, dispatchEvent('change', tslib.__assign(tslib.__assign({}, data), { value: value }))];
                    case 1:
                        rendererEvent = _b.sent();
                        if (rendererEvent === null || rendererEvent === void 0 ? void 0 : rendererEvent.prevented) {
                            return [2 /*return*/];
                        }
                        onChange === null || onChange === void 0 ? void 0 : onChange(value);
                        return [2 /*return*/];
                }
            });
        });
    };
    VerificationCodeControl.prototype.render = function () {
        var separator = this.props.separator;
        return (_J$X_(amisUi.VerificationCode, tslib.__assign({}, this.props, { separator: typeof separator === 'string'
                ? function (data) {
                    return amisCore.resolveVariableAndFilter(separator, data);
                }
                : function () { }, onFinish: this.onFinish, onChange: this.onChange })));
    };
    tslib.__decorate([
        amisCore.autobind,
        tslib.__metadata("design:type", Function),
        tslib.__metadata("design:paramtypes", [String]),
        tslib.__metadata("design:returntype", Promise)
    ], VerificationCodeControl.prototype, "onFinish", null);
    tslib.__decorate([
        amisCore.autobind,
        tslib.__metadata("design:type", Function),
        tslib.__metadata("design:paramtypes", [String]),
        tslib.__metadata("design:returntype", Promise)
    ], VerificationCodeControl.prototype, "onChange", null);
    return VerificationCodeControl;
}(React__default["default"].Component));
/** @class */ ((function (_super) {
    tslib.__extends(VerificationCodeControlRenderer, _super);
    function VerificationCodeControlRenderer() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    VerificationCodeControlRenderer = tslib.__decorate([
        amisCore.FormItem({
            type: 'input-verification-code'
        })
    ], VerificationCodeControlRenderer);
    return VerificationCodeControlRenderer;
})(VerificationCodeControl));

exports["default"] = VerificationCodeControl;
window.amisVersionInfo={version:'6.7.0',buildTime:'2024-08-06'};
