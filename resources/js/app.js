import './bootstrap';
import 'flowbite';
import 'simple-datatables/dist/style.css';

import { DataTable } from 'simple-datatables';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.simpleDatatables = { DataTable };
window.DataTable = DataTable;

Alpine.start();

const datatableOptions = {
	paging: true,
	perPage: 10,
	perPageSelect: [5, 10, 20, 50],
	firstLast: true,
	nextPrev: true,
};

const initializeSimpleDatatables = () => {
	document.querySelectorAll('[data-datatable]').forEach((table) => {
		if (table.dataset.simpleDatatableInitialized) {
			return;
		}
		new DataTable(table, { ...datatableOptions });
		table.dataset.simpleDatatableInitialized = '1';
	});
};

document.addEventListener('DOMContentLoaded', initializeSimpleDatatables);

