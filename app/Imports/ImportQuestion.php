<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportQuestion implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $question = Question::create(
            [
                'title' => $row[0],
            ]
        );

        $random = rand(1,4);

        $answers=[];
        $answers[]= $answer_1=$row[1];
        //false answer
        $answers[]=$answer_2=$row[2];
        //false answer
        $answers[]=$answer_3=$row[3];
        //false answer
        $answers[]=$answer_4=$row[4];

        //to rearrange the array order 
        shuffle($answers);

        for ($i=0;$i<count($answers);$i++){
        //that mean the true answer

        //$answer_1 is the true answer
            if(trim($answers[$i])==trim($answer_1))
            {
                Answer::create(
                    [
                        'question_id' => $question->id,
                        'title' => $answers[$i],
                        'status' => 1,
                    ]
                );
            }

            else{
                Answer::create(
                    [
                        'question_id' => $question->id,
                        'title' => $answers[$i],
                        'status' => 0,
                    ]
                );
            }
        }

        // Answer::create(
        //     [
        //         'question_id' => $question->id,
        //         'title' => $row[1],
        //         'status' => 1,
        //     ]
        // );

        // Answer::create(
        //     [
        //         'question_id' => $question->id,
        //         'title' => $row[2],
        //         'status' => 0,
        //     ]
        // );

        // Answer::create(
        //     [
        //         'question_id' => $question->id,
        //         'title' => $row[3],
        //         'status' => 0,
        //     ]
        // );

        // Answer::create(
        //     [
        //         'question_id' => $question->id,
        //         'title' => $row[4],
        //         'status' => 0,
        //     ]
        // );

        return $question;
    }
}
