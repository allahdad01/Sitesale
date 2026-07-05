<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\TeamMember;

class TeamMemberController
{
    public function index(): void
    {
        $teamMembers = TeamMember::allAdmin();
        View::render('admin.team_members.index', [
            'title'       => 'Team Members',
            'teamMembers' => $teamMembers,
        ], 'admin');
    }

    public function add(Request $request): void
    {
        $uploadDir = __DIR__ . '/../../../storage/uploads/team_members/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        $name = $request->post('name', '');
        $role = $request->post('role', '');
        $bio = $request->post('bio', '');
        $type = $request->post('type', 'member');
        $image = '';

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $image = 'team_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
            }
        }

        TeamMember::create([
            'name'       => $name,
            'name_en'    => $request->post('name_en', ''),
            'name_ps'    => $request->post('name_ps', ''),
            'name_fa'    => $request->post('name_fa', ''),
            'role'       => $role,
            'role_en'    => $request->post('role_en', ''),
            'role_ps'    => $request->post('role_ps', ''),
            'role_fa'    => $request->post('role_fa', ''),
            'bio'        => $bio,
            'bio_en'     => $request->post('bio_en', ''),
            'bio_ps'     => $request->post('bio_ps', ''),
            'bio_fa'     => $request->post('bio_fa', ''),
            'image'      => $image,
            'type'       => $type,
            'sort_order' => TeamMember::maxSortOrder() + 1,
            'active'     => 1,
        ]);

        Session::set('_success', 'Team member added.');
        Response::redirect(base_url('admin/team-members'));
    }

    public function edit(Request $request): void
    {
        $id = (int) $request->param('id');
        $member = TeamMember::find($id);

        if (!$member) {
            Session::set('_error', 'Team member not found.');
            Response::redirect(base_url('admin/team-members'));
            return;
        }

        View::render('admin.team_members.form', [
            'title'  => 'Edit Team Member',
            'member' => $member,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $id = (int) $request->param('id');
        $member = TeamMember::find($id);

        if (!$member) {
            Session::set('_error', 'Team member not found.');
            Response::redirect(base_url('admin/team-members'));
            return;
        }

        $name = $request->post('name', '');
        $role = $request->post('role', '');
        $bio = $request->post('bio', '');
        $type = $request->post('type', 'member');
        $image = $member['image'];

        $uploadDir = __DIR__ . '/../../../storage/uploads/team_members/';

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                if ($member['image']) {
                    @unlink($uploadDir . $member['image']);
                }
                $image = 'team_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
            }
        }

        TeamMember::update($id, [
            'name'    => $name,
            'name_en' => $request->post('name_en', ''),
            'name_ps' => $request->post('name_ps', ''),
            'name_fa' => $request->post('name_fa', ''),
            'role'    => $role,
            'role_en' => $request->post('role_en', ''),
            'role_ps' => $request->post('role_ps', ''),
            'role_fa' => $request->post('role_fa', ''),
            'bio'     => $bio,
            'bio_en'  => $request->post('bio_en', ''),
            'bio_ps'  => $request->post('bio_ps', ''),
            'bio_fa'  => $request->post('bio_fa', ''),
            'image'   => $image,
            'type'    => $type,
        ]);

        Session::set('_success', 'Team member updated.');
        Response::redirect(base_url('admin/team-members'));
    }

    public function toggle(Request $request): void
    {
        $id = (int) $request->param('id');
        $member = TeamMember::find($id);
        if ($member) {
            TeamMember::update($id, ['active' => $member['active'] ? 0 : 1]);
        }
        Session::set('_success', 'Team member toggled.');
        Response::redirect(base_url('admin/team-members'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        $member = TeamMember::find($id);
        if ($member) {
            if ($member['image']) {
                @unlink(__DIR__ . '/../../../storage/uploads/team_members/' . $member['image']);
            }
            TeamMember::delete($id);
        }
        Session::set('_success', 'Team member deleted.');
        Response::redirect(base_url('admin/team-members'));
    }
}
