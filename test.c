#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include "pifacedigital.h"

int main( int argc, char *argv[] )
{
	int hw_addr = 0;
	pifacedigital_open(hw_addr);
	int bobine;
	if (argc < 2)
	{
		printf("Rentrez 1 ou 2 pour indiquer la bobine\n");
		return -1;
	}
	if (atoi(argv[1]) != 1 && atoi(argv[1]) != 2)
	{
		printf("Rentrez 1 ou 2 pour indiquer la bobine\n");
		return -1;
	}
	bobine = atoi(argv[1]) -1;
	//pifacedigital_enable_interrupts();
	//pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);
	//pifacedigital_wait_for_input(-1, hw_addr);
	//pifacedigital_write_reg(0x80, OUTPUT, hw_addr);
	/*while(1)
	{
		printf("etat HAUT\n");
		pifacedigital_write_bit(1, 1, OUTPUT, hw_addr);
		pifacedigital_wait_for_input(-1, hw_addr);
		usleep(200000);
		printf("etat BAS\n");
		pifacedigital_write_bit(0, 1, OUTPUT, hw_addr);
		pifacedigital_wait_for_input(-1, hw_addr);
		usleep(200000);
	}*/
	/*char* etat = argv[1];
	if (strcmp(etat,"down") == 0)
	{
		system("gpio -p write 207 1");
	}
	else if(strcmp(etat,"up") == 0)
	{
		system("gpio -p write 207 0");
	}*/
	//pifacedigital_write_bit(1, 1, OUTPUT, hw_addr);
	//int temps = atoi(argv[1]);
	// system("gpio -p write 207 1");
	// usleep(30000);
	// system("gpio -p write 207 0");
	// usleep(temps);
	// system("gpio -p write 206 1");
	// usleep(70000);
	// system("gpio -p write 206 0");

	/*pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
	usleep(100000);
	int i = 0;
	for (i; i < 5; i++)
	{
		pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
		usleep(10000);
		pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
		usleep(10000);
		pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
		usleep(10000);
		pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
		usleep(10000);
		
	}
	pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);*/

	/**
			numéro de pin puis valeur
	*/
	//usleep(70000);
	pifacedigital_digital_write(0, 1);
	usleep(40000);
	pifacedigital_digital_write(0, 0);
	usleep(10000);
	pifacedigital_digital_write(1, 1);
	usleep(50000);
	pifacedigital_digital_write(1, 0);
	/*pifacedigital_write_reg(0xFF, OUTPUT, hw_addr);
	usleep(50000);
	pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);*/
	//usleep(10000);
	// system("gpio -p write 200 1");
	// usleep(30000);
	// system("gpio -p write 200 0");

	//pifacedigital_write_bit(0, 1, OUTPUT, hw_addr);
	//sleep(1);
	//pifacedigital_wait_for_input(-1, hw_addr);
	//pifacedigital_write_bit(0, 7, OUTPUT, hw_addr);
	//pifacedigital_write_reg(0x00, OUTPUT, hw_addr);

	//gcc -o test.c -Isrc/ -L. -lpifacedigital -L../libmcp23s17/ -lmcp23s17

	return 0;
}
