<?php

namespace SharepointUpload\SharepointUpload;

class SharepointUpload
{
    public function uploadFile($file_path, $library_name, $site_url, $client_id, $tenant_id, $client_secret, $resource)
    {
        // Fonction pour obtenir un jeton d'accès SharePoint

        function get_token_from_sharepoint($client_id, $client_secret, $resource, $tenant_id)
        {
            $token_url = "https://accounts.accesscontrol.windows.net/" . $tenant_id . "/tokens/OAuth/2/";

            $headers = array(
                'Content-Type: application/x-www-form-urlencoded'
            );

            $data = array(
                'grant_type' => 'client_credentials',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'resource' => $resource
            );

            $options = array(
                'http' => array(
                    'header' => $headers,
                    'method' => 'POST',
                    'content' => http_build_query($data),
                ),
            );
            $context  = stream_context_create($options);

            $response = file_get_contents($token_url, false, $context);
            if ($response !== false) {
                $response_data = json_decode($response, true);
                if (isset($response_data['access_token'])) {
                    return $response_data['access_token'];
                }
            }
            return null;
        }

        function upload_file_to_sharepoint($file_path, $site_url, $token, $library_name)
        {
            $upload_url = $site_url . "_api/web/GetFolderByServerRelativeUrl('" . $library_name . "')/Files/add(url='" . $file_path . "',overwrite=true)";
            $headers = array(
                'Authorization: Bearer ' . $token,
                'Accept: application/json;odata=verbose',
                'Content-Type: application/x-www-form-urlencoded',
                "Content-Length: " . filesize($file_path)
            );

            $file_data = file_get_contents($file_path);

            $options = array(
                'http' => array(
                    'header'  => $headers,
                    'method'  => 'POST',
                    'content' => $file_data,
                ),
            );
            $context  = stream_context_create($options);

            $response = file_get_contents($upload_url, false, $context);

            if ($response !== false) {

                return "Fichier téléchargé avec succès.";
            } else {
                return "Une erreur s'est produite lors du téléchargement du fichier.";
            }
        }

        $token = get_token_from_sharepoint($client_id, $client_secret, $resource, $tenant_id);
        if ($token !== null) {
            return upload_file_to_sharepoint($file_path, $site_url, $token, $library_name);
        } else {
            return "Une erreur s'est produite lors de la récupération du jeton d'authentification.";
        }
    }
}
