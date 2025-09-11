@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Transactions</h2>
    <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Transaction
    </a>
  </div>

  <div class="mb-4 flex items-center justify-between gap-2">
    <div class="flex items-center gap-2">
      <label class="inline-flex items-center text-sm">
        <input id="select-all" type="checkbox" class="mr-2"> Select all on page
      </label>
      <div class="flex gap-2 items-center">
        <select id="export-format" class="border px-2 py-1 text-sm rounded">
          <option value="csv">CSV</option>
          <option value="json">JSON</option>
        </select>
        <button id="export-selected" class="px-3 py-2 bg-primary text-white rounded text-sm opacity-50 cursor-not-allowed" disabled>Client export</button>
        <button id="server-export" class="px-3 py-2 border rounded text-sm">Server export</button>
      </div>
      <span id="selected-count" class="text-sm text-gray-600">0 selected</span>
    </div>
    <div class="text-sm text-gray-600">Tip: selections persist across pages. Use Server export for full export.</div>
  </div>

  <div class="bg-white shadow rounded-lg overflow-scroll">
    <table class="min-w-full text-sm">
      <thead class="bg-gray-50 text-left">
        <tr>
          <th class="px-4 py-2 w-10"><!-- checkbox column --></th>
          <th class="px-4 py-2">Date</th>
          <th class="px-4 py-2">Account</th>
          <th class="px-4 py-2">Category</th>
          <th class="px-4 py-2">Description</th>
          <th class="px-4 py-2">Amount</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse ($transactions as $txn)
          @php
            $rowData = [
              'id' => $txn->id,
              'date' => $txn->date->toDateString(),
              'account' => $txn->account->name ?? null,
              'category' => $txn->category->name ?? null,
              'description' => $txn->description,
              'amount' => $txn->amount,
            ];
          @endphp
          <tr data-txn='{{ json_encode($rowData, JSON_HEX_APOS|JSON_HEX_QUOT) }}'>
            <td class="px-4 py-2">
              <input type="checkbox" name="selected[]" class="txn-checkbox">
            </td>
            <td class="px-4 py-2">{{ $txn->date->format('d M Y') }}</td>
            <td class="px-4 py-2">{{ $txn->account->name }}</td>
            <td class="px-4 py-2">{{ $txn->category->name }}</td>
            <td class="px-4 py-2">{{ $txn->description ?? '-' }}</td>
            <td class="px-4 py-2 {{ $txn->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
              {{ $txn->amount }}
            </td>
            <td class="px-4 py-2">
              <div class="flex items-center space-x-3">
                <a href="{{ route('transactions.edit', $txn) }}" title="Edit" class="text-gray-600 hover:text-primary">
                  <i class="p-2 bg-primary/10 rounded text-primary ri-edit-box-line text-lg"></i>
                </a>

                @php
                  $msg = 'Are you sure you want to delete this transaction: ' . ($txn->description ?? $txn->category->name . ' on ' . $txn->date->format('d M Y'));
                @endphp
                <button type="button" title="Delete" onclick="showConfirmModal({{ json_encode($msg) }}, {{ json_encode(route('transactions.destroy', $txn)) }})" class="text-red-600 hover:text-red-800">
                  <i class="p-2 bg-red-50 rounded ri-delete-bin-line text-lg"></i>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No transactions found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $transactions->links() }}
  </div>
</div>
  @include('partials.confirm-modal')
  <script>
    const STORAGE_KEY = 'tx_selected_ids';

    function getSelectedIds(){
      try{ return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); }catch(e){ return []; }
    }

    function setSelectedIds(arr){ localStorage.setItem(STORAGE_KEY, JSON.stringify(arr)); }

    function updateSelectionCount(){
      const boxes = document.querySelectorAll('.txn-checkbox');
      const pageSelected = Array.from(boxes).filter(b => b.checked).map(b => getRowId(b));
      const stored = getSelectedIds();
      // merge pageSelected into stored
      const merged = Array.from(new Set([...stored.filter(id=>!pageSelected.includes(id)), ...pageSelected]));
      setSelectedIds(merged);
      const selected = merged.length;
      const btn = document.getElementById('export-selected');
      const count = document.getElementById('selected-count');
      count.textContent = selected + ' selected';
      if(selected>0){ btn.disabled = false; btn.classList.remove('opacity-50','cursor-not-allowed'); } else { btn.disabled = true; btn.classList.add('opacity-50','cursor-not-allowed'); }
    }

    function getRowId(cb){ return Number(cb.closest('tr').dataset.txn ? JSON.parse(cb.closest('tr').dataset.txn).id : 0); }

    document.getElementById('select-all').addEventListener('change', function(){
      const checked = this.checked;
      document.querySelectorAll('.txn-checkbox').forEach(cb => cb.checked = checked);
      updateSelectionCount();
    });

    document.querySelectorAll('.txn-checkbox').forEach(cb => cb.addEventListener('change', updateSelectionCount));

    // restore selections from storage on load
    (function restoreSelections(){
      const stored = getSelectedIds();
      if(stored.length===0) return;
      document.querySelectorAll('.txn-checkbox').forEach(cb => {
        const id = getRowId(cb);
        if(stored.includes(id)) cb.checked = true;
      });
      updateSelectionCount();
    })();

    document.getElementById('export-selected').addEventListener('click', function(){
      // client-side export exports only current page selected rows
      const rows = Array.from(document.querySelectorAll('tbody tr')).filter(tr => tr.querySelector('.txn-checkbox') && tr.querySelector('.txn-checkbox').checked);
      if(rows.length === 0) return alert('No rows selected on this page to export');
      const data = rows.map(r => JSON.parse(r.dataset.txn));
      // build CSV
      const headers = Object.keys(data[0]);
      const csv = [headers.join(',')].concat(data.map(row => headers.map(h => '"'+String(row[h] ?? '').replace(/"/g,'""')+'"').join(','))).join('\n');
      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'transactions-export.csv';
      document.body.appendChild(a);
      a.click();
      a.remove();
      URL.revokeObjectURL(url);
    });

    document.getElementById('server-export').addEventListener('click', async function(){
      const ids = getSelectedIds();
      if(!ids.length) return alert('No selected rows to export.');
      const format = document.getElementById('export-format').value || 'csv';
      const token = '{{ csrf_token() }}';
      const res = await fetch('{{ route('export.post') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
        body: JSON.stringify({ ids: ids, format: format })
      });

      const contentType = res.headers.get('content-type') || '';
      if (contentType.includes('application/json')) {
        const json = await res.json();
        if (json.queued) {
          alert(json.message || 'Export queued.');
        } else {
          alert('Export response: ' + JSON.stringify(json));
        }
        return;
      }

      // assume csv blob
      const blob = await res.blob();
      const disp = res.headers.get('content-disposition') || '';
      let filename = 'export.csv';
      const m = /filename\*?=([^;]+)/.exec(disp);
      if (m) filename = m[1].replace(/\"/g,'').trim();
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a'); a.href = url; a.download = filename; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
    });
  </script>
@endsection
