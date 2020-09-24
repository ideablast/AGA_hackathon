#!/usr/bin/env python

################################################################################################################################################################
import os
import sys
import json

import requests
from bs4 import BeautifulSoup
################################################################################################################################################################



################################################################################################################################################################
# Main
#

if __name__ == '__main__':
    JsnData = {'store_info': []}

    for IntPageNo in range(1, 9):
        response = requests.request(
            method = 'GET',
            url = 'https://www.purmeecard.com/public.do?request=merchantSelect&gu=&name=&si=03&curPage=' +str(IntPageNo),
            headers = {
                'Upgrade-Insecure-Requests': '1',
                'DNT': '1',
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36',
                'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Sec-Fetch-Site': 'same-origin',
                'Sec-Fetch-Mode': 'navigate',
                'Sec-Fetch-User': '?1',
                'Sec-Fetch-Dest': 'iframe',
                'Referer': 'https://www.purmeecard.com/public.do?request=merchantSelect',
                'Accept-Encoding': 'deflate',
                'Accept-Language': 'ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7,zh-CN;q=0.6,zh;q=0.5'
            }
        )
        ObjBS = BeautifulSoup(response.text, 'html.parser')

        LstStoreEle = ObjBS.select('div > table > tr')[1:]
        for TmpEle1 in LstStoreEle:
            TmpStr1 = TmpEle1.select_one('td:nth-child(2)').text.strip() #가맹점
            TmpStr2 = TmpEle1.select_one('td:nth-child(3)').text.strip() #전화번호
            TmpStr3 = TmpEle1.select_one('td:nth-child(4)').text.strip().replace('\xa0', ' / ') #주소
            TmpStr4 = TmpEle1.select_one('td:nth-child(7)').text.strip() #배달여부

            if len(TmpStr2) == 7:
                TmpStr2 = '062' +TmpStr2
            if TmpStr4 == '배달가능':
                TmpStr4 = 'O'
            else:
                TmpStr4 = 'X'

            JsnData['store_info'].append({'name': TmpStr1, 'phone': TmpStr2, 'address': TmpStr3, 'state': TmpStr4})

    with open('store.json', 'w', encoding='UTF8') as hFile:
        json.dump(JsnData, hFile, ensure_ascii=False)
