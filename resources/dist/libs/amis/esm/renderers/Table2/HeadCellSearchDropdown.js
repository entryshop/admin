/**
 * amis v6.7.0
 * build time: 2024-08-06
 * Copyright 2018-2024 baidu
 */

import { __extends, __assign, __awaiter, __generator } from 'tslib';
import React from 'react';
import { findDOMNode } from 'react-dom';
import { observer } from 'mobx-react';
import { setVariable, createObject } from 'amis-core';
import { HeadCellDropDown, Icon } from 'amis-ui';

var HeadCellSearchDropDown = /** @class */ (function (_super) {
    __extends(HeadCellSearchDropDown, _super);
    function HeadCellSearchDropDown(props) {
        var _this = _super.call(this, props) || this;
        _this.formItems = [];
        _this.handleSubmit = _this.handleSubmit.bind(_this);
        _this.handleAction = _this.handleAction.bind(_this);
        return _this;
    }
    HeadCellSearchDropDown.prototype.buildSchema = function () {
        var _a, _b, _c, _d, _e, _f;
        var _g = this.props, searchable = _g.searchable, sortable = _g.sortable, name = _g.name, label = _g.label, __ = _g.translate, testIdBuilder = _g.testIdBuilder;
        var schema;
        if (searchable === true) {
            schema = {
                title: '',
                controls: [
                    {
                        type: 'text',
                        name: name,
                        placeholder: label,
                        clearable: true,
                        testid: (_a = testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild(name)) === null || _a === void 0 ? void 0 : _a.getTestIdValue()
                    }
                ]
            };
        }
        else if (searchable) {
            if (searchable.controls || searchable.tabs || searchable.fieldSet) {
                schema = __assign(__assign({ title: '' }, searchable), { controls: Array.isArray(searchable.controls)
                        ? searchable.controls.concat()
                        : undefined });
            }
            else if ((searchable === null || searchable === void 0 ? void 0 : searchable.type) === 'form') {
                schema = searchable;
            }
            else {
                schema = {
                    title: '',
                    className: searchable.formClassName,
                    controls: [
                        __assign({ type: searchable.type || 'text', name: searchable.name || name, testid: (_b = testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild(searchable.name || name)) === null || _b === void 0 ? void 0 : _b.getTestIdValue(), placeholder: label }, searchable)
                    ]
                };
            }
        }
        if (schema && schema.controls && sortable) {
            schema.controls.unshift({
                type: 'hidden',
                name: 'orderBy',
                value: name
            }, {
                type: 'button-group',
                name: 'order',
                label: __('sort'),
                options: [
                    {
                        label: __('asc'),
                        value: 'asc'
                    },
                    {
                        label: __('desc'),
                        value: 'desc'
                    }
                ]
            });
        }
        if (schema) {
            // 如果schema是直接配置的{type: 'form', body: []}
            var formItems_1 = [];
            (schema.controls || schema.body || []).forEach(function (item) {
                return item.name &&
                    item.name !== 'orderBy' &&
                    item.name !== 'order' &&
                    formItems_1.push(item.name);
            });
            this.formItems = formItems_1;
            schema = __assign(__assign({}, schema), { type: 'form', wrapperComponent: 'div', wrapWithPanel: true, title: false, testid: (_c = testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild('form')) === null || _c === void 0 ? void 0 : _c.getTestIdValue(), actions: [
                    {
                        type: 'button',
                        label: __('reset'),
                        actionType: 'clear-and-submit',
                        testid: (_d = testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild('btn-reset')) === null || _d === void 0 ? void 0 : _d.getTestIdValue()
                    },
                    {
                        type: 'button',
                        label: __('cancel'),
                        actionType: 'cancel',
                        testid: (_e = testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild('btn-cancel')) === null || _e === void 0 ? void 0 : _e.getTestIdValue()
                    },
                    {
                        label: __('search'),
                        type: 'submit',
                        primary: true,
                        testid: (_f = testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild('btn-search')) === null || _f === void 0 ? void 0 : _f.getTestIdValue()
                    }
                ] });
        }
        return schema || 'error';
    };
    HeadCellSearchDropDown.prototype.handleAction = function (e, action, ctx, confirm) {
        return __awaiter(this, void 0, void 0, function () {
            var _a, onAction, data, dispatchEvent, name, values, rendererEvent;
            return __generator(this, function (_b) {
                switch (_b.label) {
                    case 0:
                        _a = this.props, onAction = _a.onAction, data = _a.data, dispatchEvent = _a.dispatchEvent, name = _a.name;
                        if (action.actionType === 'cancel' || action.actionType === 'close') {
                            confirm();
                            return [2 /*return*/];
                        }
                        if (action.actionType === 'reset') {
                            confirm();
                            this.handleReset();
                            return [2 /*return*/];
                        }
                        values = __assign({}, data);
                        this.formItems.forEach(function (key) { return setVariable(values, key, undefined); });
                        return [4 /*yield*/, dispatchEvent('columnSearch', createObject(data, {
                                searchName: name,
                                searchValue: values
                            }))];
                    case 1:
                        rendererEvent = _b.sent();
                        if (rendererEvent === null || rendererEvent === void 0 ? void 0 : rendererEvent.prevented) {
                            return [2 /*return*/];
                        }
                        onAction && onAction(e, action, ctx);
                        return [2 /*return*/];
                }
            });
        });
    };
    HeadCellSearchDropDown.prototype.handleReset = function () {
        return __awaiter(this, void 0, void 0, function () {
            var _a, onSearch, data, name, values, _b;
            return __generator(this, function (_c) {
                switch (_c.label) {
                    case 0:
                        _a = this.props, onSearch = _a.onSearch, data = _a.data, name = _a.name;
                        values = __assign({}, data);
                        this.formItems.forEach(function (key) { return setVariable(values, key, undefined); });
                        if (values.orderBy === name) {
                            values.orderBy = '';
                            values.order = 'asc';
                        }
                        _b = onSearch;
                        if (!_b) return [3 /*break*/, 2];
                        return [4 /*yield*/, onSearch(name, values)];
                    case 1:
                        _b = (_c.sent());
                        _c.label = 2;
                    case 2:
                        onSearch && onSearch(values);
                        return [2 /*return*/];
                }
            });
        });
    };
    HeadCellSearchDropDown.prototype.handleSubmit = function (values, confirm) {
        return __awaiter(this, void 0, void 0, function () {
            var _a, onSearch, name, _b;
            return __generator(this, function (_c) {
                switch (_c.label) {
                    case 0:
                        _a = this.props, onSearch = _a.onSearch, name = _a.name;
                        if (values.order) {
                            values = __assign(__assign({}, values), { orderBy: name });
                        }
                        _b = onSearch;
                        if (!_b) return [3 /*break*/, 2];
                        return [4 /*yield*/, onSearch(name, values)];
                    case 1:
                        _b = (_c.sent());
                        _c.label = 2;
                    case 2:
                        confirm();
                        return [2 /*return*/];
                }
            });
        });
    };
    HeadCellSearchDropDown.prototype.isActive = function () {
        var _a = this.props, data = _a.data, name = _a.name, orderBy = _a.orderBy;
        return ((orderBy && orderBy === name) || this.formItems.some(function (key) { return data === null || data === void 0 ? void 0 : data[key]; }));
    };
    HeadCellSearchDropDown.prototype.render = function () {
        var _this = this;
        var _a = this.props, render = _a.render, name = _a.name, data = _a.data, searchable = _a.searchable, order = _a.order, orderBy = _a.orderBy, popOverContainer = _a.popOverContainer, ns = _a.classPrefix, cx = _a.classnames, testIdBuilder = _a.testIdBuilder;
        var formSchema = this.buildSchema();
        var isActive = this.isActive();
        return (React.createElement(HeadCellDropDown, { className: "".concat(ns, "TableCell-searchBtn"), layerClassName: cx("".concat(ns, "TableCell-searchPopOver"), searchable.className), active: isActive, filterIcon: React.createElement(Icon, { icon: "search", className: "icon", iconContent: "table-search-icon", testIdBuilder: testIdBuilder === null || testIdBuilder === void 0 ? void 0 : testIdBuilder.getChild('search-icon') }), popOverContainer: popOverContainer ? popOverContainer : function () { return findDOMNode(_this); }, filterDropdown: function (_a) {
                _a.setSelectedKeys; _a.selectedKeys; var confirm = _a.confirm; _a.clearFilters;
                return render('quick-search-form', formSchema, {
                    data: __assign(__assign({}, data), { orderBy: orderBy, order: orderBy && orderBy === name ? order : '' }),
                    onSubmit: function (values) { return _this.handleSubmit(values, confirm); },
                    onAction: function (e, action, ctx) {
                        _this.handleAction(e, action, ctx, confirm);
                    }
                });
            }, testIdBuilder: testIdBuilder }));
    };
    return HeadCellSearchDropDown;
}(React.Component));
var HeadCellSearchDropDown$1 = observer(function (props) {
    var store = props.store;
    return (React.createElement(HeadCellSearchDropDown, __assign({}, props, { data: store.query, orderBy: store.orderBy, order: store.order })));
});

export { HeadCellSearchDropDown, HeadCellSearchDropDown$1 as default };
window.amisVersionInfo={version:'6.7.0',buildTime:'2024-08-06'};