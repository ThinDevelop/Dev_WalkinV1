<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Validator;

class LineNotifyController extends Controller
{

    public function sendMessage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'linetoken' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'error' => $validator->errors(),
            ], 200);
        }

        // $imagePath = public_path('images/logo/Walkin-icon-2.png');
        // if (!file_exists($imagePath)) {
        //     return response()->json([
        //         'status_code' => 404,
        //         'error' => 'File not found',
        //     ], 200);
        // }

        // ทำการส่งไฟล์ที่เปลี่ยนสิทธิ์แล้วไปยัง API โดยใช้ GuzzleHttp
        $client = new Client();
        $url = 'https://notify-api.line.me/api/notify';
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->linetoken,
            'Content-Type' => 'application/x-www-form-urlencoded',
            // 'Content-Type' => 'multipart/form-data',
        ];
        $data = [
            'message' => "ชื่อ-นามสกุล: นายเอ บี\nสาเหตุ: ขโมยของ\nบุคคลนี้พยายามเข้าสถานที่ โปรดระมัดระวัง",
        ];
        // $data = [
        //     [
        //         'name' => 'message',
        //         'contents' => "ชื่อ-นามสกุล: นายเอ บี\nสาเหตุ: ขโมยของ\nบุคคลนี้พยายามเข้าสถานที่ โปรดระมัดระวัง",
        //     ],
        //     [
        //         'name' => 'imageFile',
        //         // 'contents' => fopen($imagePath, 'r'),
        //         'contents' => Psr7\Utils::tryFopen($imagePath, 'r'),
        //     ],
        // ];

        try {

            $response = $client->post($url, [
                'headers' => $headers,
                'form_params' => $data,
                // 'multipart' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            return response()->json([
                'status_code' => $statusCode,
                'error' => $responseBody,
            ], 200);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $responseBody = $e->getResponse()->getBody()->getContents();

                return response()->json([
                    'status_code' => $statusCode,
                    'error' => $responseBody,
                ], 200);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'error' => 'Internal Server Error',
                ], 200);
            }
        }
    }
}
