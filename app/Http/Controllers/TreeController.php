<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreeRoot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TreeController extends Controller
{
    //

    public function get_tree($id) //Api get Tree in text file
    {
        $tree_values_list = array();
        $tree_roots_list = array();
        $tree_all_values_list = array();
        $symbole = '';

        $id_tree = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $tree_root = TreeRoot::where([['tree', '=', $id_tree]])->orderBy('level')->orderByDesc('order')->get();

        if (count($tree_root) > 0) {
            array_push($tree_values_list, '0-0-0');
            array_push($tree_all_values_list, '0-0-0-0');
            array_push($tree_roots_list, $tree_root[0]['root']);
            foreach ($tree_root as $root) {
                if ($root->level == 0) continue;

                $symbole = '';
                $parent_root_values = ($root->level - 1) . '-' . ($root->grandfather_order) . '-' . ($root->parent_order);
                $root_value = $root->level . '-' . $root->parent_order . '-' . $root->order;
                $root_all_value = $root->level . '-' . $root->parent_order . '-' . $root->order . '-' . $root->grandfather_order;

                for ($i = 0; $i < $root->level; $i++) {
                    $symbole .= "     ";
                    // $symbole .= "______";
                }

                $root_name = $symbole . $root->root;

                if (in_array($parent_root_values, $tree_values_list)) {
                    array_splice($tree_values_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_value]);
                    array_splice($tree_all_values_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_all_value]);
                    array_splice($tree_roots_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_name]);
                } else {
                    array_push($tree_values_list, $root_value);
                    array_push($tree_all_values_list, $root_all_value);
                    array_push($tree_roots_list, $root_name);
                }
            }
        } else {
            return response()->json(['result' => 0, 'message' => 'Arbre introuvable !']);
        }

        $data = '';
        $root_name_style = true;
        for ($i = 0; $i < count($tree_roots_list); $i++) {
            $values_root = explode('-', $tree_all_values_list[$i]);

            $value = ($values_root[0] + 1) . '-' . $values_root[2] . '-0-' . $values_root[1]; // get child (node) of this root

            if ($root_name_style) { // add Style first root in list (Root)
                $data .= $tree_roots_list[$i] . "\n";
                $root_name_style = false;
            } else if (in_array($value, $tree_all_values_list)) {  // add Style in all root
                $data .= $tree_roots_list[$i] . "\n";
            } else {
                $data .= $tree_roots_list[$i] . "\n";
            }
        }

        $tree = Tree::find($id_tree);

        $file_name = $tree->name . '.txt';
        echo $data;
        
        header('Content-Disposition: attachment; filename=' . $file_name);
    }

    public function edit_tree_index($id)
    {
        $tree_values_list = array();
        $tree_roots_list = array();
        $tree_all_values_list = array();
        $symbole = '';

        $id_tree = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $tree_root = TreeRoot::where([['tree', '=', $id_tree]])->orderBy('level')->orderByDesc('order')->get();

        if (count($tree_root) > 0) {
            array_push($tree_values_list, '0-0-0');
            array_push($tree_all_values_list, '0-0-0-0');
            array_push($tree_roots_list, $tree_root[0]['root']);
            foreach ($tree_root as $root) {
                if ($root->level == 0) continue;

                $symbole = '';
                $parent_root_values = ($root->level - 1) . '-' . ($root->grandfather_order) . '-' . ($root->parent_order);
                $root_value = $root->level . '-' . $root->parent_order . '-' . $root->order;
                $root_all_value = $root->level . '-' . $root->parent_order . '-' . $root->order . '-' . $root->grandfather_order;

                for ($i = 0; $i < $root->level; $i++) {
                    // $symbole .= "&nbsp;&nbsp;&nbsp;&nbsp;";
                    $symbole .= "______";
                }

                $root_name = $symbole . $root->root;

                if (in_array($parent_root_values, $tree_values_list)) {
                    array_splice($tree_values_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_value]);
                    array_splice($tree_all_values_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_all_value]);
                    array_splice($tree_roots_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_name]);
                } else {
                    array_push($tree_values_list, $root_value);
                    array_push($tree_all_values_list, $root_all_value);
                    array_push($tree_roots_list, $root_name);
                }
            }
        } else {
            return redirect()->back()->with(['error', "Arbre introuvable !"]);
        }

        $data = '';
        for ($i = 0; $i < count($tree_roots_list); $i++) {

            $data .= '<option value="' . $tree_all_values_list[$i] . '" id="' . $tree_all_values_list[$i] . '">' . $tree_roots_list[$i] . '</option>';
        }

        $tree = Tree::find($id_tree);
        return view('edit_tree', ['id' => $tree->id, 'name' => $tree->name, 'data' => $data]);
    }

    public function delete_tree($id)
    {
        $id_tree = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $tree_root = TreeRoot::where([['tree', '=', $id_tree]])->delete();
        $tree = Tree::where([['id', '=', $id_tree]])->delete();

        if ($tree_root && $tree) {
            return redirect()->back()->with(['success', "L'arbre a été supprimé avec succès de la base de données"]);
        }
    }

    public function show_tree_index($id)
    {
        $tree_values_list = array();
        $tree_roots_list = array();
        $tree_all_values_list = array();
        $symbole = '';

        $id_tree = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $tree_root = TreeRoot::where([['tree', '=', $id_tree]])->orderBy('level')->orderByDesc('order')->get();

        if (count($tree_root) > 0) {
            array_push($tree_values_list, '0-0-0');
            array_push($tree_all_values_list, '0-0-0-0');
            array_push($tree_roots_list, $tree_root[0]['root']);
            foreach ($tree_root as $root) {
                if ($root->level == 0) continue;

                $symbole = '';
                $parent_root_values = ($root->level - 1) . '-' . ($root->grandfather_order) . '-' . ($root->parent_order);
                $root_value = $root->level . '-' . $root->parent_order . '-' . $root->order;
                $root_all_value = $root->level . '-' . $root->parent_order . '-' . $root->order . '-' . $root->grandfather_order;

                for ($i = 0; $i < $root->level; $i++) {
                    $symbole .= "&nbsp;&nbsp;&nbsp;&nbsp;";
                    // $symbole .= "______";
                }

                $root_name = $symbole . $root->root;

                if (in_array($parent_root_values, $tree_values_list)) {
                    array_splice($tree_values_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_value]);
                    array_splice($tree_all_values_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_all_value]);
                    array_splice($tree_roots_list, (array_search($parent_root_values, $tree_values_list) + 1), 0, [$root_name]);
                } else {
                    array_push($tree_values_list, $root_value);
                    array_push($tree_all_values_list, $root_all_value);
                    array_push($tree_roots_list, $root_name);
                }
            }
        } else {
            return redirect()->back()->with(['error', "Arbre introuvable !"]);
        }

        $data = '';
        $root_name_style = true;
        for ($i = 0; $i < count($tree_roots_list); $i++) {
            $values_root = explode('-', $tree_all_values_list[$i]);

            $value = ($values_root[0] + 1) . '-' . $values_root[2] . '-0-' . $values_root[1]; // get child (node) of this root

            if ($root_name_style) { // add Style first root in list (Root)
                $data .= '<span class="tree-root-name">' . $tree_roots_list[$i] . '</span></br>';
                $root_name_style = false;
            } else if (in_array($value, $tree_all_values_list)) {  // add Style in all root
                $data .= '<span class="tree-root-node">' . $tree_roots_list[$i] . '</span></br>';
            } else {
                $data .= $tree_roots_list[$i] . '</br>';
            }
        }

        // foreach($tree_roots_list as $root_name) {
        //     echo $root_name.'</br>';
        // }

        // return $tree_roots_list;
        $tree = Tree::find($id_tree);
        return view('show_tree', ['id' => $tree->id, 'name' => $tree->name, 'count' => count($tree_root), 'data' => $data]);
    }

    public function all_trees_index()
    {
        return view('all_trees');
    }

    public function add_tree_index()
    {
        return view('add_tree');
    }

    public function add_tree(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'root' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => 0, 'message' => 'Erreur : un des champs est vide']);
        }

        $tree = Tree::create([
            'name' => $request->name,
        ]);

        if (!empty($tree)) {
            $tree_root = TreeRoot::create([
                'tree' => $tree->id,
                'root' => $request->root,
                'level' => 0,
                'parent_order' => 0,
                'order' => 0,
                'grandfather_order' => 0,
            ]);
            if (!empty($tree_root)) {
                return response()->json(['result' => 1, 'message' => 'Arbre ajouté avec succès', 'data' => $tree->id]);
            }
        } else {
            return response()->json(['result' => 0, 'message' => 'Erreur : un des champs est vide']);
        }
    }

    public function add_tree_node(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tree' => 'required|integer',
            'node' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => 0, 'message' => 'Erreur : un des champs est vide']);
        }

        $value = explode('-', $request->value);

        $tree_root = TreeRoot::create([
            'tree' => $request->tree,
            'root' => $request->node,
            'level' => $value[0],
            'parent_order' => $value[1],
            'order' => $value[2],
            'grandfather_order' => $value[3],
        ]);

        if (!empty($tree_root)) {
            return response()->json(['result' => 1, 'message' => 'Nœud ajouté avec succès']);
        } else {
            return response()->json(['result' => 0, 'message' => 'Erreur : un des champs est vide']);
        }
    }
}
