@extends('layouts.app')

@section('title', 'Room Command Center')
@section('meta_description', 'Kelola ruang diskusi — buat, ubah, dan pantau room tanpa berpindah halaman.')

@section('content')
<style>
    .rcc-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #1D9E75;
        display: inline-block;
    }

    .rcc-code-pill {
        font-size: 11px;
        font-family: monospace;
        background: #E1F5EE;
        color: #085041;
        padding: 2px 8px;
        border-radius: 999px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-create {
        background-color: #1D9E75;
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background-color 0.15s;
    }
    .btn-create:hover { background-color: #0F6E56; }

    .btn-ghost {
        background: var(--color-surface-container-high, #f3f3f3);
        color: var(--color-on-surface-variant, #555);
        border: 1px solid var(--color-outline-variant, #ddd);
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity 0.15s;
    }
    .btn-ghost:hover { opacity: 0.8; }

    .btn-edit-sm {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 6px;
        background: #E6F1FB;
        color: #0C447C;
        border: none;
        cursor: pointer;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        transition: background-color 0.15s;
    }
    .btn-edit-sm:hover { background: #B5D4F4; }

    .btn-del-sm {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 6px;
        background: #FCEBEB;
        color: #791F1F;
        border: none;
        cursor: pointer;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        transition: background-color 0.15s;
    }
    .btn-del-sm:hover { background: #F7C1C1; }

    .btn-danger {
        background-color: #A32D2D;
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background-color 0.15s;
    }
    .btn-danger:hover { background-color: #791F1F; }
    .btn-danger:disabled { opacity: 0.6; cursor: not-allowed; }

    .alert-success {
        background: #E1F5EE;
        border: 1px solid #5DCAA5;
        color: #085041;
    }
    .alert-error {
        background: #FCEBEB;
        border: 1px solid #F09595;
        color: #791F1F;
    }

    /* FIX: shared modal overlay — keduanya pakai class ini */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 50;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    .modal-overlay.open {
        display: flex;
    }
</style>

<section class="min-h-screen px-4 py-10 md:px-8">
    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <div class="mb-2 inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs"
                    style="border-color: var(--color-outline-variant); color: #0F6E56; background: #E1F5EE;">
                    <span class="rcc-badge-dot"></span>
                    Room Control
                </div>
                <h1 class="text-2xl font-bold md:text-3xl" style="color: var(--color-on-surface);">
                    Room command center
                </h1>
                <p class="mt-1 text-sm" style="color: var(--color-on-surface-variant);">
                    Kelola ruang diskusi — buat, ubah, dan pantau room tanpa berpindah halaman.
                </p>
            </div>
            <div class="flex items-center gap-2 text-xs" style="color: var(--color-on-surface-variant);">
                <span>Last refresh</span>
                <span id="lastRefresh" class="rounded-md border px-2 py-1 text-xs"
                    style="border-color: var(--color-outline-variant); color: var(--color-on-surface);">
                    --:--
                </span>
            </div>
        </div>

        {{-- Alert --}}
        <div id="alertBox" class="hidden rounded-lg border px-4 py-3 text-sm" role="alert"></div>

        {{-- Main Grid --}}
        <div class="grid gap-5 lg:grid-cols-5">

            {{-- Form Panel --}}
            <div class="rounded-2xl border p-5 lg:col-span-2"
                style="background-color: var(--color-surface-container, #f9f9f9); border-color: var(--color-outline-variant);">
                <p class="mb-4 flex items-center gap-2 text-base font-semibold"
                    style="color: var(--color-on-surface);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true" style="color: var(--color-on-surface-variant);">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Quick create
                </p>

                <div class="space-y-4">
                    <div>
                        <label for="roomName" class="mb-1 block text-sm font-medium"
                            style="color: var(--color-on-surface-variant);">
                            Nama room <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="roomName"
                            type="text"
                            placeholder="contoh: Diskusi Frontend"
                            class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none focus:ring-2"
                            style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);"
                        />
                    </div>
                    <div class="flex gap-2">
                        <button type="button" id="createBtn" class="btn-create">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Create
                        </button>
                    </div>
                </div>
            </div>

            {{-- Directory Panel --}}
            <div class="rounded-2xl border p-5 lg:col-span-3"
                style="background-color: var(--color-surface-container, #f9f9f9); border-color: var(--color-outline-variant);">
                <div class="mb-4 flex items-center justify-between">
                    <p class="flex items-center gap-2 text-base font-semibold"
                        style="color: var(--color-on-surface);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true" style="color: var(--color-on-surface-variant);">
                            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                        </svg>
                        Room directory
                    </p>
                    <button type="button" id="refreshBtn" class="btn-ghost" style="font-size: 12px; padding: 5px 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <polyline points="23 4 23 10 17 10"/>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                        </svg>
                        Refresh
                    </button>
                </div>
                <div id="roomsBody" class="flex flex-col gap-3">
                    <div class="flex flex-col items-center justify-center py-10 text-center"
                        style="color: var(--color-on-surface-variant);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true" class="mb-2 opacity-40">
                            <ellipse cx="12" cy="5" rx="9" ry="3"/>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                        </svg>
                        <p class="text-sm">Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Edit Modal --}}
<div id="editModalOverlay" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
    <div class="w-full max-w-md rounded-2xl border p-6"
        style="background-color: var(--color-surface-container, #fff); border-color: var(--color-outline-variant);">
        <div class="mb-5 flex items-center justify-between">
            <h2 id="editModalTitle" class="flex items-center gap-2 text-lg font-semibold"
                style="color: var(--color-on-surface);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit room
            </h2>
            <button type="button" id="closeModalBtn" class="btn-ghost"
                style="padding: 3px 10px; font-size: 12px;" aria-label="Tutup modal">
                Tutup
            </button>
        </div>

        <input type="hidden" id="editRoomId" />

        <div class="space-y-4">
            <div>
                <label for="editRoomName" class="mb-1 block text-sm font-medium"
                    style="color: var(--color-on-surface-variant);">
                    Nama room <span class="text-red-500">*</span>
                </label>
                <input
                    id="editRoomName"
                    type="text"
                    placeholder="Nama room"
                    class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none"
                    style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);"
                />
            </div>
            <div>
                <label for="editRoomDescription" class="mb-1 block text-sm font-medium"
                    style="color: var(--color-on-surface-variant);">
                    Deskripsi
                </label>
                <textarea
                    id="editRoomDescription"
                    rows="3"
                    placeholder="Tambahkan deskripsi singkat"
                    class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none resize-none"
                    style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);"
                ></textarea>
            </div>
            <div class="flex gap-2 pt-1">
                <button type="button" id="saveEditBtn" class="btn-create">Simpan perubahan</button>
                <button type="button" id="cancelEditBtn" class="btn-ghost">Batal</button>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModalOverlay" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
    <div class="w-full max-w-md rounded-2xl border p-6"
        style="background-color: var(--color-surface-container, #fff); border-color: var(--color-outline-variant);">
        <div class="mb-4 flex items-center justify-between">
            <h2 id="deleteModalTitle" class="flex items-center gap-2 text-lg font-semibold"
                style="color: var(--color-on-surface);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true" style="color: #A32D2D;">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4h6v2"/>
                </svg>
                Hapus room
            </h2>
            <button type="button" id="closeDeleteBtn" class="btn-ghost"
                style="padding: 3px 10px; font-size: 12px;" aria-label="Tutup modal">
                Tutup
            </button>
        </div>

        <input type="hidden" id="deleteRoomId" />

        {{-- Preview nama room yang akan dihapus --}}
        <div class="mb-4 rounded-lg border px-4 py-3"
            style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant);">
            <p class="text-xs" style="color: var(--color-on-surface-variant);">Room yang akan dihapus</p>
            <p id="deleteRoomName" class="mt-1 text-sm font-semibold" style="color: var(--color-on-surface);">-</p>
        </div>

        <p class="text-sm" style="color: var(--color-on-surface-variant);">
            Tindakan ini tidak bisa dibatalkan. Room akan dihapus secara permanen.
        </p>

        <div class="mt-5 flex gap-2">
            <button type="button" id="confirmDeleteBtn" class="btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4h6v2"/>
                </svg>
                Ya, hapus room
            </button>
            <button type="button" id="cancelDeleteBtn" class="btn-ghost">Batal</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const apiBase    = '/api/room';
    const roomsBody  = document.getElementById('roomsBody');
    const alertBox   = document.getElementById('alertBox');
    const csrfToken  = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // ─── Helpers ─────────────────────────────────────────────────────────────

    function showAlert(message, type = 'success') {
        alertBox.textContent = message;
        alertBox.className   = 'rounded-lg border px-4 py-3 text-sm ' + (type === 'error' ? 'alert-error' : 'alert-success');
        alertBox.classList.remove('hidden');
        setTimeout(() => alertBox.classList.add('hidden'), 3500);
    }

    function updateTime() {
        document.getElementById('lastRefresh').textContent =
            new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    }

    function requestHeaders() {
        const headers = { 'Content-Type': 'application/json' };
        if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
        return headers;
    }

    async function parseError(response) {
        const data = await response.json().catch(() => ({}));
        if (data.message) return data.message;
        if (data.errors)  return Object.values(data.errors).flat().join(' ');
        return 'Terjadi kesalahan pada server.';
    }

    function escapeHtml(str) {
        return String(str ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // ─── Render ───────────────────────────────────────────────────────────────

    function renderRooms(rooms) {
        updateTime();

        if (!rooms.length) {
            roomsBody.innerHTML = `
                <div class="flex flex-col items-center justify-center py-10 text-center"
                    style="color: var(--color-on-surface-variant);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true" class="mb-2 opacity-40">
                        <ellipse cx="12" cy="5" rx="9" ry="3"/>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                    </svg>
                    <p class="text-sm">Belum ada data room.</p>
                </div>`;
            return;
        }

        // FIX: tambah data-name di tombol Hapus supaya nama bisa dipass ke modal
        roomsBody.innerHTML = rooms.map(room => `
            <div class="rounded-xl border p-4"
                style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant);">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold" style="color: var(--color-on-surface);">
                            ${escapeHtml(room.name)}
                        </p>
                        <p class="mt-1 text-xs" style="color: var(--color-on-surface-variant);">
                            ${escapeHtml(room.description ?? 'Belum ada deskripsi.')}
                        </p>
                    </div>
                    <span class="rcc-code-pill">${escapeHtml(room.code ?? '-')}</span>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="flex items-center gap-1 text-xs" style="color: var(--color-on-surface-variant);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        ${escapeHtml(room.creator?.name ?? '-')}
                    </span>
                    <div class="flex gap-2">
                        <button class="btn-edit-sm" data-action="edit" data-id="${room.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit
                        </button>
                        <button class="btn-del-sm" data-action="delete" data-id="${room.id}" data-name="${escapeHtml(room.name)}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14H6L5 6"/>
                                <path d="M10 11v6M14 11v6"/>
                                <path d="M9 6V4h6v2"/>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // ─── API Calls ────────────────────────────────────────────────────────────

    async function fetchRooms() {
        try {
            const res = await fetch(apiBase, { credentials: 'same-origin' });
            if (!res.ok) { showAlert(await parseError(res), 'error'); return; }
            renderRooms(await res.json());
        } catch {
            showAlert('Gagal menghubungi server.', 'error');
        }
    }

    async function createRoom() {
        const name = document.getElementById('roomName').value.trim();
        if (!name) { showAlert('Nama room wajib diisi.', 'error'); return; }

        try {
            const res = await fetch(apiBase, {
                method:      'POST',
                headers:     requestHeaders(),
                credentials: 'same-origin',
                body:        JSON.stringify({ name }),
            });
            if (!res.ok) { showAlert(await parseError(res), 'error'); return; }
            showAlert('Room berhasil dibuat.');
            document.getElementById('roomName').value = '';
            await fetchRooms();
        } catch {
            showAlert('Gagal membuat room.', 'error');
        }
    }

    async function updateRoom() {
        const id          = document.getElementById('editRoomId').value;
        const name        = document.getElementById('editRoomName').value.trim();
        const description = document.getElementById('editRoomDescription').value.trim() || null;

        if (!name) { showAlert('Nama room wajib diisi.', 'error'); return; }

        try {
            const res = await fetch(`${apiBase}/${id}`, {
                method:      'PUT',
                headers:     requestHeaders(),
                credentials: 'same-origin',
                body:        JSON.stringify({ name, description }),
            });
            if (!res.ok) { showAlert(await parseError(res), 'error'); return; }
            showAlert('Room berhasil diupdate.');
            closeEditModal(); // FIX: panggil closeEditModal(), bukan closeModal()
            await fetchRooms();
        } catch {
            showAlert('Gagal mengupdate room.', 'error');
        }
    }

    async function deleteRoom() {
        const id        = document.getElementById('deleteRoomId').value;
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (!id) return;

        // Nonaktifkan tombol supaya tidak bisa double-click
        confirmBtn.disabled    = true;
        confirmBtn.textContent = 'Menghapus...';

        try {
            const res = await fetch(`${apiBase}/${id}`, {
                method:      'DELETE',
                headers:     requestHeaders(),
                credentials: 'same-origin',
            });
            if (!res.ok) { showAlert(await parseError(res), 'error'); return; }
            showAlert('Room berhasil dihapus.');
            closeDeleteModal();
            await fetchRooms();
        } catch {
            showAlert('Gagal menghapus room.', 'error');
        } finally {
            // Kembalikan tombol ke kondisi awal
            confirmBtn.disabled   = false;
            confirmBtn.innerHTML  = `
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4h6v2"/>
                </svg>
                Ya, hapus room`;
        }
    }

    // ─── Edit Modal ───────────────────────────────────────────────────────────

    function openEditModal(room) {
        document.getElementById('editRoomId').value          = room.id;
        document.getElementById('editRoomName').value        = room.name ?? '';
        document.getElementById('editRoomDescription').value = room.description ?? '';
        document.getElementById('editModalOverlay').classList.add('open');
        document.getElementById('editRoomName').focus();
    }

    function closeEditModal() {
        document.getElementById('editModalOverlay').classList.remove('open');
        document.getElementById('editRoomId').value          = '';
        document.getElementById('editRoomName').value        = '';
        document.getElementById('editRoomDescription').value = '';
    }

    // ─── Delete Modal ─────────────────────────────────────────────────────────

    function openDeleteModal(id, name) {
        document.getElementById('deleteRoomId').value        = id;
        document.getElementById('deleteRoomName').textContent = name || '-'; // tampilkan nama di preview
        document.getElementById('deleteModalOverlay').classList.add('open');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModalOverlay').classList.remove('open');
        document.getElementById('deleteRoomId').value        = '';
        document.getElementById('deleteRoomName').textContent = '-';
    }

    // ─── Event Listeners ──────────────────────────────────────────────────────

    document.getElementById('createBtn').addEventListener('click', createRoom);
    document.getElementById('refreshBtn').addEventListener('click', fetchRooms);

    // Edit modal
    document.getElementById('saveEditBtn').addEventListener('click', updateRoom);
    document.getElementById('closeModalBtn').addEventListener('click', closeEditModal);
    document.getElementById('cancelEditBtn').addEventListener('click', closeEditModal);
    document.getElementById('editModalOverlay').addEventListener('click', e => {
        if (e.target === e.currentTarget) closeEditModal();
    });

    // Delete modal
    document.getElementById('confirmDeleteBtn').addEventListener('click', deleteRoom);
    document.getElementById('closeDeleteBtn').addEventListener('click', closeDeleteModal);
    document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);
    document.getElementById('deleteModalOverlay').addEventListener('click', e => {
        if (e.target === e.currentTarget) closeDeleteModal();
    });

    // Escape — tutup modal mana pun yang sedang terbuka
    document.addEventListener('keydown', e => {
        if (e.key !== 'Escape') return;
        closeEditModal();
        closeDeleteModal();
    });

    // Delegasi klik dari card room
    roomsBody.addEventListener('click', async e => {
        const btn = e.target.closest('[data-action]');
        if (!btn) return;

        const { action, id, name } = btn.dataset;

        if (action === 'delete') {
            // FIX: pass nama langsung dari data-name, tidak perlu fetch ulang
            openDeleteModal(id, name);
            return;
        }

        if (action === 'edit') {
            try {
                const res = await fetch(`${apiBase}/${id}`, { credentials: 'same-origin' });
                if (!res.ok) { showAlert(await parseError(res), 'error'); return; }
                openEditModal(await res.json());
            } catch {
                showAlert('Gagal memuat data room.', 'error');
            }
        }
    });

    // ─── Init ─────────────────────────────────────────────────────────────────

    fetchRooms();
</script>
@endpush