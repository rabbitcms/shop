define(["require", "exports", "jquery"], function (require, exports, $) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    function init() {
    }
    exports.init = init;
    function table(portlet) {
        var dataTable = new Datatable();
        var tableSelector = $('.data-table', portlet);
        dataTable.init({
            src: tableSelector,
            dataTable: {
                ajax: {
                    url: tableSelector.data('link')
                },
                ordering: false
            }
        });
        tableSelector.on('change', '.form-filter', function () {
            dataTable.submitFilter();
        });
        MicroEvent.bind('users.updated', function () {
            dataTable.getDataTable().ajax.reload();
        });
        portlet.on('click', '[rel="destroy"]', function () {
            var self = $(this);
            var link = self.attr('href');
            RabbitCMS.Dialogs.onDelete(link, function () {
                dataTable.getDataTable().ajax.reload();
            });
            return false;
        });
        portlet.on('click', '[rel="create"]', function (e) {
            e.preventDefault();
        });
    }
    exports.table = table;
    var MicroEvent = new RabbitCMS.MicroEvent({});
});
//# sourceMappingURL=shop.js.map