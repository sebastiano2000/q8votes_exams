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
    private $subjectId;

    public function __construct($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    public function model(array $row)
    {

        if (empty($row[0])) {
            return null;
        }

        $question = Question::create(
            [
                'title' => $row[0],
                'subject_id' => $this->subjectId,
            ]
        );

        $answers = [];
        $answers[] = $answer_1 = $row[1];
        $answers[] = $answer_2 = $row[2];
        $answers[] = $answer_3 = $row[3];
        $answers[] = $answer_4 = $row[4];

        shuffle($answers);

        for ($i = 0; $i < count($answers); $i++) {
            if (trim($answers[$i]) == trim($answer_1)) {
                Answer::create(
                    [
                        'question_id' => $question->id,
                        'title' => $answers[$i],
                        'status' => 1,
                    ]
                );
            } else {
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
