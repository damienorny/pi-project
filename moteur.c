#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include "pifacedigital.h"

int Coord(int Chgt);
int Deplacement(int Bouge);

int main( int argc, char *argv[] )
{
	int nbPas, mode, verif;
	mode = atoi(argv[1]);
	int hw_addr = 0;
	pifacedigital_open(hw_addr);
	pifacedigital_enable_interrupts();
	pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);

	if(mode == 1)
	{
		nbPas = atoi(argv[2]);
		verif = Coord(7*nbPas);

		if(verif == 0)
		{
			pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
			usleep(100000);
			int i = 0;

			if (nbPas > 0)
			{
				for (i; i < nbPas; i++)
				{
					pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
					usleep(20000);
					pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
					usleep(20000);
					pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
					usleep(20000);
					pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
					usleep(20000);
				}
			}
			else
			{
				nbPas = abs(nbPas);
				for (i; i < nbPas; i++)
				{
					pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
					usleep(20000);
					pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
					usleep(20000);
					pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
					usleep(20000);
					pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
					usleep(20000);
				}
			}
			
			pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);
		}
	}
	else if(mode == 2)
	{
		//system("CAPTURE")
		int mvt;
		mvt = system("python traitement.py");
		if (mvt < 330 || mvt > 310)
		{
			system("./scripts/test")
		}
		else
		{
			int Correction;
			char CorrectionC[50];
			Correction = mvt - 320;
			Correction = Correction / 66;
			verif = Coord(7*Correction);

			if (verif == 0)
			{
				Deplacement(Correction);
				system("./scripts/moteur 2");
			}
		}
	}
	return 0;
}

int Coord(int Chgt)
{
	FILE* fichier = NULL;
	char chaine[5] = "";
	float NCoord = 0; 
	fichier = fopen("Coordonnees.txt", "r+");

	if (fichier == NULL)
    {
    	printf("Impossible d'ouvrir le fichier texte");
    }

    fgets(chaine, 3, fichier);
    fclose(fichier);

    NCoord = atoi(chaine);
    NCoord = NCoord + Chgt;

    if(NCoord < 0 || NCoord > 180)
    {
    	return -1;
    }
    else
    {
    	fichier = fopen("Coordonnees.txt", "w+");
	    fprintf(fichier, "%d",NCoord);
	    fclose(fichier);
		return 0;
    }
}

int Deplacement(int Bouge)
{
	pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
	usleep(100000);
	int i = 0;

	if (Bouge > 0)
	{
		for (i; i < Bouge; i++)
		{
			pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
			usleep(20000);
		}
	}
	else
	{
		Bouge = abs(Bouge);
		for (i; i < Bouge; i++)
		{
			pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
			usleep(20000);
		}
	}
	
	pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);
}