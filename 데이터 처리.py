#!/usr/bin/env python

################################################################################################################################################################
import os
import sys
import json
import random
################################################################################################################################################################


LST_MENU = [
    '숯불 닭갈비', '철판 닭갈비', '막국수', '닭 볶음탕', '누룽지 백숙', '오리고기', '닭 한마리', '삼계탕', '돼지갈비', '뼈해장국', '감자탕',
    '샤브샤브', '순두부', '부대찌개', '육개장', '육회', '칼국수', '추어탕', '서브웨이 샌드위치', '한솥', '봉구스 밥버거', '양꼬치', '생어거스틴', '인도 카레',
    '참치김밥', '라볶이', '죠스 떡볶이', '튀김', '순대', '이삭토스트', '명량핫도그', '팥죽', '돈코츠 라멘', '타코야끼', '야끼소바', '오꼬노미야끼', '돈까스', '소바'
]

def GetRandomFoodList():
    Result = '['

    for _ in range(random.randint(1, 11)):
        Result += '{\\"food\\": \\"' +LST_MENU[random.randint(0, len(LST_MENU) -1)] +'\\", \\"price\\": \\"' +str(random.randint(8, 21) *500) +'\\"}, '

    return Result[0:-2] +']'


################################################################################################################################################################
# Main
#

if __name__ == '__main__':
    with open('store.json', 'r', encoding='UTF8') as hFile:
        JsnData = json.load(hFile)

    TmpStr1 = 'INSERT INTO STORE (SE_NAME, SE_ADDRESS, SE_PHONE, SE_MENU) VALUES '
    for TmpJsn1 in JsnData['store_info']:
        if TmpJsn1['state'] == 'O':
            TmpStr2 = TmpJsn1['name'].replace('\'', r'\\\'')
            TmpStr3 = TmpJsn1['address'].replace('\'', r'\\\'')
            TmpStr4 = TmpJsn1['phone'].replace('\'', r'\\\'')
            TmpStr1 += '("' +TmpStr2 +'", "' +TmpStr3 +'", "' +TmpStr4 +'", "{\\"food_info\\": ' +GetRandomFoodList() +'}"), \n'
    TmpStr1 = TmpStr1[0:-3] +';'

    print(TmpStr1)
