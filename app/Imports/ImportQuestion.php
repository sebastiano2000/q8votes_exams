<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Subject;
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
        $subject = Subject::updateorCreate(
            [
                'name' => trim($row[5]),
            ],
            [
                'name' => trim($row[5]),
            ]
        );

        $question = Question::create(
            [
                'title' => $row[0],
                'subject_id' => $subject->id,
            ]
        );

        $answers=[];
        $answers[]= $answer_1=$row[1];
        $answers[]=$answer_2=$row[2];
        $answers[]=$answer_3=$row[3];
        $answers[]=$answer_4=$row[4];

        shuffle($answers);

        for ($i=0;$i<count($answers);$i++){
            if(trim($answers[$i])==trim($answer_1)){
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

        return $question;
    }
}
