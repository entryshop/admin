import React from 'react';
import { ClassNamesFn, ITableStore, SchemaNode, ActionObject, LocaleProps, OnEventProps, RendererEvent } from 'amis-core';
import { ActionSchema } from '../Action';
import { SchemaTpl } from '../../Schema';
import type { IColumn, IRow, TestIdBuilder } from 'amis-core';
export interface TableContentProps extends LocaleProps {
    className?: string;
    tableClassName?: string;
    classnames: ClassNamesFn;
    testIdBuilder?: TestIdBuilder;
    columns: Array<IColumn>;
    columnsGroup: Array<{
        label: string;
        index: number;
        colSpan: number;
        rowSpan: number;
        has: Array<any>;
    }>;
    rows: Array<IRow>;
    placeholder?: string | SchemaTpl;
    render: (region: string, node: SchemaNode, props?: any) => JSX.Element;
    onMouseMove?: (event: React.MouseEvent) => void;
    onScroll: (event: React.UIEvent) => void;
    tableRef: (table?: HTMLTableElement | null) => void;
    renderHeadCell: (column: IColumn, props?: any) => JSX.Element;
    renderCell: (region: string, column: IColumn, item: IRow, props: any) => React.ReactNode;
    onCheck: (item: IRow, value: boolean, shift?: boolean) => void;
    onRowClick: (item: IRow, index: number) => Promise<RendererEvent<any> | void>;
    onRowDbClick: (item: IRow, index: number) => Promise<RendererEvent<any> | void>;
    onRowMouseEnter: (item: IRow, index: number) => Promise<RendererEvent<any> | void>;
    onRowMouseLeave: (item: IRow, index: number) => Promise<RendererEvent<any> | void>;
    onQuickChange?: (item: IRow, values: object, saveImmediately?: boolean | any, savePristine?: boolean) => void;
    footable?: boolean;
    footableColumns: Array<IColumn>;
    checkOnItemClick?: boolean;
    buildItemProps?: (item: IRow, index: number) => any;
    onAction?: (e: React.UIEvent<any>, action: ActionObject, ctx: object) => void;
    rowClassNameExpr?: string;
    affixRowClassName?: string;
    prefixRowClassName?: string;
    rowClassName?: string;
    data?: any;
    prefixRow?: Array<any>;
    affixRow?: Array<any>;
    itemAction?: ActionSchema;
    itemActions?: Array<ActionObject>;
    store: ITableStore;
    dispatchEvent?: Function;
    onEvent?: OnEventProps;
    loading?: boolean;
    columnWidthReady?: boolean;
    someChecked?: boolean;
    allChecked?: boolean;
    isSelectionThresholdReached?: boolean;
    orderBy?: string;
    orderDir?: string;
    children?: React.ReactNode;
}
export declare function renderItemActions(props: Pick<TableContentProps, 'itemActions' | 'render' | 'store' | 'classnames'>): React.JSX.Element | null;
export declare class TableContent extends React.PureComponent<TableContentProps> {
    render(): React.JSX.Element;
}
declare const _default: (props: TableContentProps) => React.JSX.Element;
export default _default;
