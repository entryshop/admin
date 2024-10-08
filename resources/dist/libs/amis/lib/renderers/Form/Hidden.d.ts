import React from 'react';
import { FormControlProps } from 'amis-core';
import { FormBaseControlSchema } from '../../Schema';
/**
 * Hidden 隐藏域。功能性组件
 * 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/form/hidden
 */
export interface HiddenControlSchema extends FormBaseControlSchema {
    type: 'hidden';
}
export default class HiddenControl extends React.Component<FormControlProps, any> {
    render(): null;
}
export declare class HiddenControlRenderer extends HiddenControl {
}
