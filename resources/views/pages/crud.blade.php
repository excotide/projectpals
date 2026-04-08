@extends('layouts.app')

@section('title', 'CRUD Test API - User Skills')
@section('meta_description', 'Halaman sederhana untuk uji CRUD API user skills')

@section('content')
<section class="min-h-screen px-6 py-10 overflow-hidden" style="background: radial-gradient(circle at 10% 0%, rgba(0,212,255,0.18), transparent 40%), radial-gradient(circle at 90% 10%, rgba(80,255,48,0.12), transparent 35%), var(--color-surface);">
	<div class="mx-auto max-w-6xl space-y-6">
		<div class="rounded-xl border p-6 md:p-8" style="background-color: rgba(17,32,54,0.85); border-color: rgba(133,147,152,0.25); backdrop-filter: blur(8px);">
			<a href="{{ route('landing') }}" class="text-sm font-medium hover:underline" style="color: var(--color-primary);">&larr; Kembali ke Landing</a>
			<h1 class="mt-3 text-3xl md:text-4xl font-bold" style="color: var(--color-on-surface);">CRUD Test API: User Skills</h1>
			<p class="mt-2" style="color: var(--color-on-surface-variant);">
				Endpoint: <strong>/api/user-skills</strong>. Sekarang pakai <strong>nama user</strong>, bukan input user ID.
			</p>
		</div>

		<div id="alert" class="hidden rounded-md border px-4 py-3 text-sm"></div>

		<div class="grid gap-6 lg:grid-cols-5">
			<div class="lg:col-span-2 rounded-xl border p-5 md:p-6" style="background-color: var(--color-surface-container); border-color: var(--color-outline-variant);">
				<h2 class="mb-4 text-xl font-semibold" style="color: var(--color-on-surface);">Form User Skill</h2>
				<form id="skillForm" class="space-y-4">
					<div>
						<label for="skillId" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">ID (isi saat update)</label>
						<input id="skillId" type="number" class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="contoh: 1" />
					</div>
					<div>
						<label for="userName" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Nama User *</label>
						<input id="userName" type="text" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="contoh: Budi" />
					</div>
					<div>
						<label for="skillName" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Skill Name *</label>
						<input id="skillName" type="text" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="Laravel" />
					</div>
					<div>
						<label for="skillLevel" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Skill Level</label>
						<input id="skillLevel" type="text" class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="Beginner / Intermediate / Expert" />
					</div>
					<div class="flex flex-wrap gap-3 pt-2">
						<button type="button" id="createBtn" class="rounded-md px-4 py-2 font-semibold transition hover:opacity-90" style="background-color: var(--color-primary-container); color: var(--color-on-primary);">Create</button>
						<button type="button" id="updateBtn" class="rounded-md px-4 py-2 font-semibold transition hover:opacity-90" style="background-color: var(--color-tertiary); color: var(--color-on-tertiary);">Update</button>
						<button type="button" id="resetBtn" class="rounded-md px-4 py-2 font-semibold transition hover:opacity-90" style="background-color: var(--color-surface-container-highest); color: var(--color-on-surface);">Reset</button>
					</div>
				</form>
			</div>

			<div class="lg:col-span-3 rounded-xl border p-5 md:p-6" style="background-color: var(--color-surface-container); border-color: var(--color-outline-variant);">
				<div class="mb-4 flex items-center justify-between">
					<h2 class="text-xl font-semibold" style="color: var(--color-on-surface);">Data User Skills</h2>
					<button id="refreshBtn" class="rounded-md px-4 py-2 font-semibold transition hover:opacity-90" style="background-color: var(--color-secondary-container); color: var(--color-on-surface);">Refresh</button>
				</div>
				<div class="overflow-x-auto rounded-md border" style="border-color: var(--color-outline-variant);">
					<table class="min-w-full text-left text-sm">
						<thead style="background-color: var(--color-surface-container-high); color: var(--color-on-surface);">
							<tr>
								<th class="px-3 py-2">ID</th>
								<th class="px-3 py-2">Nama User</th>
								<th class="px-3 py-2">Skill Name</th>
								<th class="px-3 py-2">Skill Level</th>
								<th class="px-3 py-2">Aksi</th>
							</tr>
						</thead>
						<tbody id="skillsTableBody" style="background-color: rgba(13,28,50,0.65);"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('scripts')
<script>
	const apiBase = '/api/user-skills';
	const tableBody = document.getElementById('skillsTableBody');
	const alertBox = document.getElementById('alert');

	const fields = {
		id: document.getElementById('skillId'),
		userName: document.getElementById('userName'),
		skillName: document.getElementById('skillName'),
		skillLevel: document.getElementById('skillLevel'),
	};

	function showAlert(message, type = 'success') {
		alertBox.textContent = message;
		alertBox.classList.remove('hidden', 'border', 'bg-rose-50', 'text-rose-800');
		alertBox.style.backgroundColor = 'rgba(80,255,48,0.12)';
		alertBox.style.borderColor = 'rgba(80,255,48,0.35)';
		alertBox.style.color = 'var(--color-on-surface)';

		if (type === 'error') {
			alertBox.style.backgroundColor = 'rgba(147,0,10,0.35)';
			alertBox.style.borderColor = 'rgba(255,180,171,0.4)';
			alertBox.style.color = 'var(--color-error)';
			return;
		}
	}

	function clearForm() {
		fields.id.value = '';
		fields.userName.value = '';
		fields.skillName.value = '';
		fields.skillLevel.value = '';
	}

	function fillForm(skill) {
		fields.id.value = skill.id;
		fields.userName.value = skill.user?.name ?? '';
		fields.skillName.value = skill.skill_name;
		fields.skillLevel.value = skill.skill_level ?? '';
	}

	function payloadFromForm() {
		return {
			user_name: fields.userName.value.trim(),
			skill_name: fields.skillName.value.trim(),
			skill_level: fields.skillLevel.value.trim() || null,
		};
	}

	async function parseError(response) {
		const data = await response.json().catch(() => ({}));
		if (data.message) return data.message;
		if (data.errors) return Object.values(data.errors).flat().join(' ');
		return 'Terjadi kesalahan pada server.';
	}

	async function fetchSkills() {
		const response = await fetch(apiBase);

		if (!response.ok) {
			showAlert(await parseError(response), 'error');
			return;
		}

		const skills = await response.json();
		renderTable(skills);
	}

	function renderTable(skills) {
		if (!skills.length) {
			tableBody.innerHTML = '<tr><td colspan="5" class="px-3 py-4 text-center" style="color: var(--color-on-surface-variant);">Belum ada data skill.</td></tr>';
			return;
		}

		tableBody.innerHTML = skills.map((skill) => `
			<tr style="border-bottom: 1px solid var(--color-outline-variant); color: var(--color-on-surface);" onmouseover="this.style.backgroundColor='rgba(39,53,76,0.55)'" onmouseout="this.style.backgroundColor='transparent'">
				<td class="px-3 py-2">${skill.id}</td>
				<td class="px-3 py-2">${skill.user?.name ?? '-'}</td>
				<td class="px-3 py-2">${skill.skill_name}</td>
				<td class="px-3 py-2">${skill.skill_level ?? '-'}</td>
				<td class="px-3 py-2">
					<button data-action="edit" data-id="${skill.id}" class="mr-2 rounded px-3 py-1" style="background-color: rgba(168,232,255,0.2); color: var(--color-primary);">Edit</button>
					<button data-action="delete" data-id="${skill.id}" class="rounded px-3 py-1" style="background-color: rgba(147,0,10,0.35); color: var(--color-error);">Delete</button>
				</td>
			</tr>
		`).join('');
	}

	async function createSkill() {
		const response = await fetch(apiBase, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(payloadFromForm()),
		});

		if (!response.ok) {
			showAlert(await parseError(response), 'error');
			return;
		}

		showAlert('User skill berhasil dibuat.');
		clearForm();
		await fetchSkills();
	}

	async function updateSkill() {
		const id = fields.id.value;
		if (!id) {
			showAlert('Isi ID dulu untuk update data.', 'error');
			return;
		}

		const response = await fetch(`${apiBase}/${id}`, {
			method: 'PUT',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(payloadFromForm()),
		});

		if (!response.ok) {
			showAlert(await parseError(response), 'error');
			return;
		}

		showAlert('User skill berhasil diupdate.');
		clearForm();
		await fetchSkills();
	}

	async function deleteSkill(id) {
		const confirmed = window.confirm('Hapus data ini?');
		if (!confirmed) return;

		const response = await fetch(`${apiBase}/${id}`, { method: 'DELETE' });

		if (!response.ok) {
			showAlert(await parseError(response), 'error');
			return;
		}

		showAlert('User skill berhasil dihapus.');
		await fetchSkills();
	}

	tableBody.addEventListener('click', async (event) => {
		const target = event.target;
		const action = target.dataset.action;
		const id = target.dataset.id;

		if (!action || !id) return;

		if (action === 'delete') {
			await deleteSkill(id);
			return;
		}

		if (action === 'edit') {
			const response = await fetch(`${apiBase}/${id}`);
			if (!response.ok) {
				showAlert(await parseError(response), 'error');
				return;
			}
			fillForm(await response.json());
		}
	});

	document.getElementById('createBtn').addEventListener('click', createSkill);
	document.getElementById('updateBtn').addEventListener('click', updateSkill);
	document.getElementById('refreshBtn').addEventListener('click', fetchSkills);
	document.getElementById('resetBtn').addEventListener('click', clearForm);

	fetchSkills();
</script>
@endpush
